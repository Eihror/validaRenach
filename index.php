<?php

    /*
     * Validação de Renach
     * Autor: Igor Melo
     * PS.: Essa validação é realizada somente para o NUMERO que existe no renach, ele é composto por 11 caracteres
     * onde 2 são o estado e 9 são numeros que seguem um código.... ex.:PE123456789
     * Porém existe uma validação para isso.
     */

    //Inicia as variaveis que serão necessárias durante o decorrer do sistema
    $resultado = "";
    $ultimaPosicaoRenach = "";
    $arraySoma = array();
    $soma = "";
    $resto = "";
    $digito = "";
    
    //Caso não tenha sido enviado vazio o renach ele entra no if
    if(!empty($_POST)){
        //Jogo o valor recebido numa variaveis para manter maior organização
        $renach = $_POST['txtRenach'];
        //Caso o tamanaho do renach for maior que 9 ou menor que 9, ele já dará erro
        if(strlen($renach) > 9 || strlen($renach) < 9){
            $resultado = 'Renach informado está errado';
        }else{
            //transformo o renach num array que eu possa realizar todos os calculos
            $arrayRenach = str_split($renach);
            //Defino a ultima posição do array numa variavel
            $ultimaPosicaoRenach = $arrayRenach[8];
            
            //defino mais duas variaveis
            $i = 9;
            $key = 0;
            //Enquanto a variavel $i for mais ou igual a 2,
            while($i >= 2){
                //ele fará a mutiplicação do valor na posição com o valor de $i
                $arraySoma[] = $arrayRenach[$key]*$i;
                //Retirarei 1 da variavel $i
                $i--;
                //Adicionarei 1 na variavel $key
                $key++;
            }
            
            /*
             * Por que eu fiz isso acima? Como funciona a validação de renach?
             * O renach é validado da seguinte maneira, cada numero do renach é multiplicado por um numero em seguencia.
             * 
             * ex:   1   2   3   4   5   6   7   8   9
             *       9   8   7   6   5   4   3   2
             * 
             * ou seja, a primeira posição será multiplicada por 9, a segunda por 8, a terceira por 7 e assim sucessivamente.
             * A ultima posição não foi multiplicada por nada, por que?
             * Ela é a posição para fazer a validação se o renach está correto, como explicarei abaixo
             */
            
            //Então após esses calculos, faremos a soma de todos os valores dentro das posições dos arrays.
            //Esse exemplo feito por exemplo deu 156
            $soma = array_sum($arraySoma);
            
            //Agora iremos pegar o resto da divisão do valor que retornou por 11
            //Por que esse 11? não existe bem uma explicação esse é um padrão usado para esses tipos de códigos.
            //Por exemplo boletos tem o módulo11 e o 10
            $resto = $soma % 11;
            
            //Então verificamos o resto, caso seja memor ou igual a 1, o $digito será 0
            if($resto <= 1){
                $digito = 0;
            // Caso não, o $digito será 11 menos o resto
            }else{
                $digito = (11 - $resto);
            }
            
            //Nesse caso o resto 2, então o $digito será 9
            //Aqui realizaremos um if/else para validar se o $digito é igual a $ultimaPosicaoRenach
            //Caso seja igual, então o renach é valido.
            if($digito == $ultimaPosicaoRenach){
                $resultado = "Renach ".$renach." válido!";
            }else{
                $resultado = "Renach ".$renach." inválido!";
            }
            
        }
    }

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Validar Renach</title>
    </head>
    <body>
        <form action="" method="post">
            <label for="txtRenach">
                Renach:<br />
                <input type="text" name="txtRenach" id="txtRenach" maxlength="9">
            </label>
            <input type="submit" value="Validar">
        </form>
        <div>
            <?php if(!empty($resultado)){ echo $resultado; } ?>
        </div>
    </body>
</html>
