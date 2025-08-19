<?php

/**
 * Controlador de Ventas
 *
 * Esta clase controla las operaciones relacionadas con la caja y ventas.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\DetalleVentasModel;
use App\Models\ProductosModel;
use App\Models\TemporalCajaModel;
use App\ThirdParty\Fpdf\Fpdf;
use App\ThirdParty\NumerosALetras;

class Ventas extends BaseController
{
    protected $ventasModel;

    public function __construct()
    {
        $this->ventasModel = model('VentasModel');
    }

    // Cargar catálogo de ventas activas
    public function index()
    {
        $ventas = $this->ventasModel->mostrarVentas(1);
        return view('ventas/index', ['ventas' => $ventas]);
    }

    // Cargar catálogo de ventas canceladas
    public function bajas()
    {
        $ventas = $this->ventasModel->mostrarVentas(0);
        return view('ventas/eliminados', ['ventas' => $ventas]);
    }

    // Guarda venta
    public function guarda()
    {
        $temporalModel = new TemporalCajaModel();
        $configModel   = new ConfiguracionModel();

        $idVentaTmp = $this->request->getPost('id_venta');

        $datos = [
            'folio' => str_pad($configModel->ultimoFolio(), 10, 0, STR_PAD_LEFT),
            'total' => preg_replace('/[\$,]/', '', $this->request->getPost('total')),
            'fecha' => date('Y-m-d H:i:s'),
            'usuario_id' => $this->session->get('usuarioId'),
            'activo' => 1
        ];

        $idVenta = $this->ventasModel->insert($datos);

        if ($idVenta) {
            $configModel->siguienteFolio();

            $ventaTmp = $temporalModel->where('id_venta', $idVentaTmp)->findAll();

            $detalleVentasModel = new DetalleVentasModel();
            $productosModel     = new ProductosModel();

            foreach ($ventaTmp as $productoTmp) {
                $producto = [
                    'venta_id'    => $idVenta,
                    'producto_id' => $productoTmp['id_producto'],
                    'nombre'      => $productoTmp['nombre'],
                    'cantidad'    => $productoTmp['cantidad'],
                    'precio'      => $productoTmp['precio'],
                ];

                $detalleVentasModel->insert($producto);

                $datosProducto = $productosModel->find($productoTmp['id_producto']);

                if ($datosProducto['inventariable'] == 1) {
                    $productosModel->actualizaStock($productoTmp['id_producto'], $productoTmp['cantidad'], '-');
                }
            }
        }

        $temporalModel->eliminaVenta($idVentaTmp);

        return redirect()->to(base_url('ventas/muestraTicket/' . $idVenta));
    }

    // Muesta ticket de venta
    public function verTicket($idVenta)
    {
        $datosVenta   = $this->ventasModel->find($idVenta);

        if ($datosVenta) {
            return view('ventas/ticket', ['idVenta' => $idVenta]);
        } else {
            return view('ventas/mensaje', ['mensaje' => 'No se encontró información.']);
        }
    }

    // Genera ticket de venta
    public function generaTicket($idVenta)
    {
        $detalleVentasModel = new DetalleVentasModel();
        $configuracionModel = new ConfiguracionModel();

        $configuraciones = $configuracionModel->findAll();
        $configuracionArray = [];

        foreach ($configuraciones as $configuracion) {
            $configuracionArray[$configuracion['nombre']] = $configuracion['valor'];
        }

        $datosVenta   = $this->ventasModel->find($idVenta);
        $detalleVenta = $detalleVentasModel->where('venta_id', $idVenta)->findAll();

        $pdf = new Fpdf('P', 'mm', array(80, 250));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Ticket");
        $pdf->SetFont('Arial', 'B', 9);

        $fecha = substr($datosVenta['fecha'], 0, 10);
        $hora = substr($datosVenta['fecha'], 11, 8);

        $total = $datosVenta['total'];

        $pdf->Multicell(60, 4, mb_convert_encoding($configuracionArray['tienda_nombre'], 'ISO-8859-1', 'UTF-8'), 0, 'C', 0);

        $pdf->SetFont('Arial', '', 7);
        $pdf->Multicell(70, 4, mb_convert_encoding($configuracionArray['tienda_direccion'], 'ISO-8859-1', 'UTF-8'), 0, 'C', 0);
        $pdf->Multicell(70, 4, mb_convert_encoding($configuracionArray['tienda_telefono'], 'ISO-8859-1', 'UTF-8'), 0, 'C', 0);

        $pdf->SetFont('Arial', '', 8);
        $pdf->Ln();
        $pdf->Cell(60, 4, mb_convert_encoding('Nº ticket:  ', 'ISO-8859-1', 'UTF-8') . $datosVenta['folio'], 0, 1, 'L');

        $pdf->Cell(60, 4, '=========================================', 0, 1, 'L');

        $pdf->Cell(7, 3, 'Cant.', 0, 0, 'L');
        $pdf->Cell(36, 3, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $pdf->Cell(14, 3, 'Precio', 0, 0, 'L');
        $pdf->Cell(14, 3, 'Importe', 0, 1, 'L');
        $pdf->Cell(70, 3, '------------------------------------------------------------------------', 0, 1, 'L');

        $pdf->SetFont('Arial', '', 6.5);

        foreach ($detalleVenta as $producto) {
            $importe  = number_format(($producto['cantidad'] * $producto['precio']), 2, '.', ',');
            $pdf->Cell(7, 3, $producto['cantidad'], 0, 0, 'C');
            $y = $pdf->GetY();
            $pdf->MultiCell(36, 3, mb_convert_encoding($producto['nombre'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
            $y2 = $pdf->GetY();
            $pdf->SetXY(48, $y);
            $pdf->Cell(14, 3, '$ ' . number_format($producto['precio'], 2, '.', ','), 0, 1, 'C');
            $pdf->SetXY(62, $y);
            $pdf->Cell(14, 3, '$ ' . $importe, 0, 1, 'C');
            $pdf->SetY($y2);
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 4, 'Total', 0, 0, 'R');
        $pdf->Cell(20, 4, '$ ' . number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(70, 4, 'Son ' . ucfirst(strtolower(NumerosALetras::convertir($total, 'pesos', 'centavos'))), 0, 'L', 0);

        $pdf->Ln();
        $pdf->Cell(10);
        $pdf->Cell(30, 4, 'Fecha: ' . date("d/m/Y", strtotime($fecha)), 0, 0, 'L');
        $pdf->Cell(30, 4, 'Hora: ' . $hora, 0, 1, 'L');

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Multicell(70, 4, mb_convert_encoding($configuracionArray['ticket_leyenda'], 'ISO-8859-1', 'UTF-8'), 0, 'C', 0);

        if ($datosVenta['activo'] == 0) {
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetFontSize(24);
            $pdf->SetY(30);
            $pdf->Cell(0, 5, 'Venta cancelada', 0, 0, 'C');
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("Ticket.pdf", 'I');
    }

    // Cancela venta
    public function cancelar($id)
    {
        $this->ventasModel->update($id, ['activo' => 0]);

        $detalleVentasModel = new DetalleVentasModel();
        $productosModel     = new ProductosModel();

        $detalleVenta = $detalleVentasModel->where('venta_id', $id)->findAll();

        foreach ($detalleVenta as $productoTmp) {
            $datosProducto = $productosModel->where('id', $productoTmp['producto_id'])->first();
            if ($datosProducto['inventariable'] == 1) {
                $productosModel->actualizaStock($productoTmp['producto_id'], $productoTmp['cantidad'], '+');
            }
        }

        return redirect()->to(base_url('ventas'));
    }
}
