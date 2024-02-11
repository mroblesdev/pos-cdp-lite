<?php

/**
 * Plantilla de FPDF para crear reporte de productos
 *
 * Esta clase agregar un encabezado y pie de página para cada hoja.
 * Tambien crea una tabla a partir de multicells de tamaño dinamico
 * para que el texto se ajuste al tamaño asignado de la columna.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\ThirdParty\Fpdf;

use App\ThirdParty\Fpdf\Fpdf;

class PlantillaProductos extends Fpdf
{
	private $widths;
	private $aligns;
	private $datos;

	public function __construct($orientacion, $medida, $tamanio, $_datos)
	{
		$this->datos = $_datos;
		parent::__construct($orientacion, $medida, $tamanio);
	}

	public function Header()
	{
		$this->Image($this->datos['logo'], 10, 5, 15, 0, 'PNG');
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(15);
		$y = $this->GetY();
		$this->Multicell(130, 5, $this->datos['titulo'], 0, 'C', 0);

		$this->SetXY(155, $y);
		$this->SetFont('Arial', '', 8);
		$this->Cell(50, 4, 'Fecha: ' . date('d/m/Y h:i'), 0, 1, 'R');

		$this->Ln(8);
	}

	public function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->SetTextColor(128);
		$this->Cell(0, 10, mb_convert_encoding('Página: ', 'ISO-8859-1', 'UTF-8') . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}

	public function SetWidths($w)
	{
		$this->widths = $w;
	}

	public function SetAligns($a)
	{
		$this->aligns = $a;
	}

	public function row($data)
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->nbLines($this->widths[$i], $data[$i]));
		}
		$h = 5 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak();
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h);
			//Print the text
			$this->MultiCell($w, 5, mb_convert_encoding($data[$i], 'ISO-8859-1', 'UTF-8'), 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	public function CheckPageBreak()
	{
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + 10 > $this->PageBreakTrigger) {
			$this->AddPage($this->CurOrientation);
			$this->SetFont('Arial', 'B', 8);
			$this->Row(['Código', 'Nombre', 'Precio', 'Inventariable', 'Existencias']);
			$this->SetFont('Arial', '', 7);
		}
	}

	private function nbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0) {
			$w = $this->w - $this->rMargin - $this->x;
		}
		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 && $s[$nb - 1] == "\n") {
			$nb--;
		}
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ') {
				$sep = $i;
			}
			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j) {
						$i++;
					}
				} else {
					$i = $sep + 1;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else {
				$i++;
			}
		}
		return $nl;
	}
}
