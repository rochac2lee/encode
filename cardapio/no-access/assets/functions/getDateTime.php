<?php

date_default_timezone_set('America/Brasilia');
$dateTime = date('d/m/Y H:i:s');

echo "

<div class='form-group'>
<label>Data e Hora da Solução</label>
<input readonly class='form-control' type='text' name='data_solucao' value='$dateTime' />
</div>

";

?>
