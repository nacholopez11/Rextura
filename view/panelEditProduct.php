<form action=<?=url.'?controller=product&action=editProduct'?> method='post'>
    <input type="hidden" name ='id' value = <?=$product->getId()?>>
    <input name ='idDis' disabled value = <?=$product->getId()?>>
    <input name ='nombre' value = <?=$product->getName()?>> 
    <button type='submit' name='edit'>Editar</button>
</form>