<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      $input['cpf'] = $value;

      $j=0;

      for($i=0; $i<(strlen($input['cpf'])); $i++) 
      {
        if(is_numeric($input['cpf'][$i]))
        {
          $num[$j]=$input['cpf'][$i];
          $j++;
        }
      }

      if($j==0) { return false; }

      if(count($num)!=11) { 
        return false; 
      } else {
        for($i=0; $i<10; $i++) 
        {
          if ($num[0]==$i && $num[1]==$i && $num[2]==$i && $num[3]==$i && $num[4]==$i && $num[5]==$i && $num[6]==$i && $num[7]==$i && $num[8]==$i)
          {
            return false;
            break;
          }
        }
      }

      if(!isset($isCpfValid)){
        $j=10;
        for($i=0; $i<9; $i++){
          $multiplica[$i]=$num[$i]*$j;
          $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma%11;
        if($resto<2) {
          $dg=0;
        } else {
          $dg=11-$resto;
        }
        if($dg!=$num[9]){
          return false;
        }
      }

      if(!isset($isCpfValid)) {
        $j=11;

        for($i=0; $i<10; $i++){
          $multiplica[$i]=$num[$i]*$j;
          $j--;
        }

        $soma = array_sum($multiplica);
        $resto = $soma%11;
        
        if($resto<2){
          $dg = 0;
        } else {
          $dg = 11-$resto;
        }

        if($dg!=$num[10]) {
          return false;
        } else {
          return true;
        }
      }

      return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
      return 'O :attribute é inválido.';
    }
}
