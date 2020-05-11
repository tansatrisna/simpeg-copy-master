<?php
require('fpdf.php');

class ST extends FPDF
{
var $widths;
var $aligns;
function Header()
	{
		$logo=kopsurat('logo');
		$this->SetFillColor(255,255,255);
		$this->SetFont("Times", "B",14);
		$ci = & get_instance();
		$unit=dekrip($ci->uri->segment('4'));
		$seo=$ci->uri->segment('3');
		
		$tahun=$ci->session->tahun;
        $jenis=$ci->session->jenis;
        if($tahun=='')
        {
            $tahun=date('Y');
        }


		
		
		if($logo != '')
		{
		$this->image(base_url().'assets/img/'.$logo,10,5,30);
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
		if($jenis!='')
		{
		$this->Cell(270, 5, 'DAFTAR PENELITIAN '.$jenis, '', 0,'C');
		}	
		else
		{
			$this->Cell(270, 5, 'DAFTAR PENELITIAN SDM', '', 0,'C');
		}

		if($unit!='')
		{
		$this->Ln();
		$this->Cell(270, 5, viewUnit($unit), '', 0,'C');	
		
		}

		$this->Ln();
		$this->Cell(270, 5, 'Tahun '.$tahun, '', 0,'C');
		$this->Ln(7);
		
		$this->SetFont("Arial", "B", 10);
		$this->Cell(10, 6, 'No', 'LTBR', 0,'C');
		$this->Cell(60, 6, 'Nama/ Unit', 'TBR', 0,'C');	
		$this->Cell(120, 6, 'Judul Penelitian', 'TR', 0,'C');
		$this->Cell(50, 6, 'Sumber Dana', 'LBTR', 0,'C');
		$this->Cell(30, 6, 'Biaya', 'LBTR', 0,'C');
		
		$this->Ln(6);
		
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

function imageCenterCell($file, $x, $y, $w, $h)
	{
		if (!file_exists($file)) 
		{
			$this->Error('File does not exist: '.$file);
		}
		else
		{
			list($width, $height) = getimagesize($file);
			$ratio=$width/$height;
			$zoneRatio=$w/$h;
			// Same Ratio, put the image in the cell
			if ($ratio==$zoneRatio)
			{
				$this->Image($file, $x, $y, $w, $h);
			}
			// Image is vertical and cell is horizontal
			if ($ratio<$zoneRatio)
			{
				$neww=$h*$ratio; 
				$newx=$x+(($w-$neww)/2);
				$this->Image($file, $newx, $y, $neww);
			}
			// Image is horizontal and cell is vertical
			if ($ratio>$zoneRatio)
			{
				$newh=$w/$ratio; 
				$newy=$y+(($h-$newh)/2);
				$this->Image($file, $x, $newy, $w);
			}
		}
	}
function Row6($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=6*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		if($i==0)
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		}
		else
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
		}
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,6,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function Row8($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=6*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		if($i==0)
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
		}
		else
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
		}
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
		if($i==0)
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
		}
		else if($i==4)
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
		}
		else
		{
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';	
		}
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

function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }

function Rotate($angle,$x=-1,$y=-1)
{
	if($x==-1)
		$x=$this->x;
	if($y==-1)
		$y=$this->y;
	if($this->angle!=0)
		$this->_out('Q');
	$this->angle=$angle;
	if($angle!=0)
	{
		$angle*=M_PI/180;
		$c=cos($angle);
		$s=sin($angle);
		$cx=$x*$this->k;
		$cy=($this->h-$y)*$this->k;
		$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	}
}

function _endpage()
{
	if($this->angle!=0)
	{
		$this->angle=0;
		$this->_out('Q');
	}
	parent::_endpage();
}

function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}



}
?>
