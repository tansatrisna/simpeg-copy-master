<?php
require('fpdf.php');

class ST extends FPDF
{
var $widths;
var $aligns;
function Header()
	{
		$ci = & get_instance();
		// $jenis=$ci->session->jenis;
		// $unit=$ci->session->unit;
		$logo=kopsurat('logo');
		$this->SetFillColor(255,255,255);
		$this->SetFont("Times", "B",14);
		if($logo != '')
		{
		$this->image(base_url().'assets/img/'.$logo,10,10,25);
		}
		$this->cell(30);
		$this->SetX(26); $this->Cell(255, 6, kopsurat('header'),'',0,'C');
		$this->Ln();
		$this->SetFont("Times", "B", 14);
		$this->SetX(26); $this->Cell(255, 6, kopsurat('subheader'),'',0,'C');
		$this->SetFont("Times", "", 12);
		$this->Ln();
		$this->Cell(40, 5, '','',0,'L');
		$this->Cell(25, 5, 'Kampus I','',0,'L'); 
		$this->Cell(5, 5, ':','',0,'C'); 
		$this->MultiCell(200, 5, kopsurat('kampus1'),'',1,'L',0);
		$this->Cell(40, 5, '','',0,'L');
		$this->Cell(25, 5, 'Kampus II','',0,'L'); 
		$this->Cell(5, 5, ':','',0,'C'); 
		$this->MultiCell(190, 5, kopsurat('kampus2'),'',1,'L',0);
		$this->Cell(40, 5, '','',0,'L');
		$this->Cell(25, 5, '','',0,'L'); 
		$this->Cell(5, 5, '','',0,'C'); 
		$this->MultiCell(190, 5, kopsurat('kabprop'),'',1,'L',0);
		$this->SetX(10);$this->Cell(190, 2, '', 'B', 1,'C');
		$this->Ln(0);
		//$this->SetX(15);$this->Cell(185, 1, '', 'B', 1,'C');
		$this->Ln(0);
		$this->SetX(10);$this->Cell(270, 0.2, '', 'B', 1,'C');	
		$this->Ln(5);
		$this->SetFont("Arial", "B", 12);
		if($jenis=='')
		{
		$this->Cell(270, 7, 'DAFTAR PEGAWAI DAN DOSEN DI INSTITUT AGAMA KRISTEN NEGERI TARUTUNG', '', 0,'C');
		}	
		else
		{
		$this->Cell(270, 7, 'DAFTAR '.$jenis.' DI INSTITUT AGAMA KRISTEN NEGERI TARUTUNG', '', 0,'C');
		}
		$this->Ln();
		if($unit!='')
		{
		$this->Cell(270, 7, 'UNIT : '.strtouppper(viewUnit($unit)), '', 0,'C');	
		$this->Ln();
		}
		
		$this->SetFont("Arial", "B", 10);
		$this->Cell(10, 20, 'No', 'LTBR', 0,'C');
		
		$this->Cell(20, 20, 'Photo', 'TBR', 0,'C');
		$this->Cell(60, 7, 'Nama', 'TR', 0,'C');	
		$this->Cell(50, 7, 'Email', 'TR', 0,'C');
		$this->Cell(85, 7, 'No. SK', 'TR', 0,'C');
		$this->Cell(50, 7, 'Status', 'TR', 0,'C');
		$this->Ln(5);
		
		$this->Cell(30, 0, '', '', 0,'C');
		$this->Cell(60, 6, 'Tempat/ Tanggal Lahir', 'R', 0,'C');	
		$this->Cell(50, 6, 'HP', 'R', 0,'C');
		$this->Cell(85, 6, 'Masa Kerja', 'R', 0,'C');
		$this->Cell(50, 6, 'Pangkat/ Gol.', 'R', 0,'C');
		$this->Ln(5);

		$this->Cell(30, 0, '', '', 0,'C');
		$this->Cell(60, 6, 'Nomor Induk Pegawai', 'R', 0,'C');	
		$this->Cell(50, 6, 'NIK', 'R', 0,'C');
		$this->Cell(85, 6, 'Alamat/ Kode Pos', 'R', 0,'C');
		$this->Cell(50, 6, 'Jabatan Fungsional', 'R', 0,'C');
		$this->Ln(5);

		$this->Cell(30, 0, '', '', 0,'C');
		$this->Cell(60, 5, 'Jenis Kelamin', 'BR', 0,'C');	
		$this->Cell(50, 5, 'NPWP', 'BR', 0,'C');
		$this->Cell(85, 5, 'Pendidikan', 'BR', 0,'C');
		$this->Cell(50, 5, 'Jabatan Struktural', 'BR', 0,'C');
		$this->Ln(5);
	}
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
}
?>
