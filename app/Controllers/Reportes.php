<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\ThirdParty\Fpdf\PlantillaVentas;

class Reportes extends BaseController
{
    public function creaVentas()
    {
        return view('reportes/crea_ventas');
    }

    // Muesta el reporte de venta
    public function verReporteVentas()
    {
        $reglas = [
            'fecha_inicio' => ['label' => 'fecha de inicio', 'rules' => 'required'],
            'fecha_fin'    => ['label' => 'fecha de fin', 'rules' => 'required'],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['fecha_inicio', 'fecha_fin', 'estado']);

        return view('reportes/ver_reporte_ventas', ['post' => $post]);
    }

    public function generaVentas($inicio, $fin, $estaus)
    {
        $ventasModel = new VentasModel();
        $ventas = $ventasModel->ventasRango($inicio, $fin, $estaus);

        $logo = base_url('images/logotipo.png');

        $datos = [
            'titulo' => 'Reporte de ventas',
            'logo' => $logo,
            'inicio' => $this->ordenarFecha($inicio),
            'fin' => $this->ordenarFecha($fin)
        ];

        $pdf = new PlantillaVentas('P', 'mm', 'letter', $datos);
        $pdf->SetTitle('Reporte de ventas');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetWidths([60, 60, 60]);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Row(['Fecha', 'Folio', 'Total']);
        $pdf->SetFont('Arial', '', 9);

        $total = 0;
        $numVentas = 0;

        foreach ($ventas as $venta) {
            $pdf->row(
                [
                    $this->ordenarFechaHora($venta['fecha_alta']),
                    $venta['folio'],
                    '$ ' . number_format($venta['total'], 2, '.', ',')
                ]
            );
            $total = $total + $venta['total'];
            ++$numVentas;
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(120, 5, 'Total', 0, 0, 'R');
        $pdf->Cell(60, 5, '$ ' . number_format($total, 2, '.', ','), 1, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(70, 5, mb_convert_encoding('Número de ventas: ', 'ISO-8859-1', 'UTF-8') . $numVentas, 0, 0, 'L');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ReporteVentas.pdf", "I");
    }

    private function ordenarFecha($fecha)
    {
        $arreglo = explode("-", $fecha);
        return $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0];
    }

    private function ordenarFechaHora($fechaHora)
    {
        $fecha = substr($fechaHora, 0, 10);
        $hora = substr($fechaHora, 11);
        $arreglo = explode("-", $fecha);
        return $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0] . ' ' . $hora;
    }
}
