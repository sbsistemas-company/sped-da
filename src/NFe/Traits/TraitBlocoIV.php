<?php

namespace NFePHP\DA\NFe\Traits;

/**
 * Bloco totais da NFCe
 */
trait TraitBlocoIV
{
    protected function blocoIV($y)
    {
        //$this->bloco4H = 13;

        //$aFont = ['font'=> $this->fontePadrao, 'size' => 7, 'style' => ''];
        //$this->pdf->textBox($this->margem, $y, $this->wPrint, $this->bloco4H, '', $aFont, 'T', 'C', true, '', false);

        $qtd = $this->det->length;
        $valor = $this->getTagValue($this->ICMSTot, 'vNF');
        $desconto = $this->getTagValue($this->ICMSTot, 'vDesc');
        $bruto = $valor + $desconto;

        $aFont = ['font'=> $this->fontePadrao, 'size' => 8, 'style' => ''];
        $texto = "Qtde total de itens";
        $this->pdf->textBox(
            $this->margem,
            $y,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'L',
            false,
            '',
            false
        );
        $y1 = $this->pdf->textBox(
            $this->margem+$this->wPrint/2,
            $y,
            $this->wPrint/2,
            3,
            $qtd,
            $aFont,
            'T',
            'R',
            false,
            '',
            false
        );

        $texto = "Valor Total R$";
        $this->pdf->textBox(
            $this->margem,
            $y+$y1,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'L',
            false,
            '',
            false
        );
        $texto = number_format((float) $bruto, 2, ',', '.');
        $y2 = $this->pdf->textBox(
            $this->margem+$this->wPrint/2,
            $y+$y1,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'R',
            false,
            '',
            false
        );

        $texto = "Desconto R$";
        $this->pdf->textBox(
            $this->margem,
            $y+$y1+$y2,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'L',
            false,
            '',
            false
        );
        $texto = number_format((float) $desconto, 2, ',', '.');
        $y3 = $this->pdf->textBox(
            $this->margem+$this->wPrint/2,
            $y+$y1+$y2,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'R',
            false,
            '',
            false
        );
        $fsize = 10;
        if ($this->paperwidth < 70) {
            $fsize = 8;
        }
        $aFont = ['font'=> $this->fontePadrao, 'size' => $fsize, 'style' => 'B'];
        $texto = "Valor a Pagar R$";
        $this->pdf->textBox(
            $this->margem,
            $y+$y1+$y2+$y3,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'L',
            false,
            '',
            false
        );
        $texto = number_format((float) $valor, 2, ',', '.');
        $y4 = $this->pdf->textBox(
            $this->margem+$this->wPrint/2,
            $y+$y1+$y2+$y3,
            $this->wPrint/2,
            3,
            $texto,
            $aFont,
            'T',
            'R',
            false,
            '',
            false
        );

        $this->pdf->dashedHLine($this->margem, $this->bloco4H+$y, $this->wPrint, 0.1, 30);
        return $this->bloco4H + $y;
    }

    protected function PosIV($pos)
    {
        //$this->bloco4H = 13;
        $v1 = $this->getTagValue($this->ICMSTot, 'vNF');
        $d1 = $this->getTagValue($this->ICMSTot, 'vDesc');
        $qtd = str_pad($this->det->length, 42, " ", STR_PAD_LEFT);
        $valor = str_pad(number_format((float) $v1 , 2, ",", "."), 29, " ", STR_PAD_LEFT);
        $desconto = str_pad(number_format((float) $d1, 2, ",", "."),50, " ", STR_PAD_LEFT);
        $bruto = str_pad(number_format((float) ($v1 + $d1), 2, ",", "."), 47, " ", STR_PAD_LEFT);;
        $pos .= "<left><font.B>Qtde total de itens:{$qtd}<br>Valor Total R$:{$bruto}<br>Desconto R$:{$desconto}<br><font.A><b>Valor a Pagar R$:{$valor}</b><br></font.B></left>";

        return $pos;
    }

}
