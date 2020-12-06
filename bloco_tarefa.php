<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja excluir essa tarefa?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-primary" data-dismiss="modal">Não</button>
            <a href="/delete.php?=<?php echo $value['id_tarefa']?>"><button type="button" class="btn-primary">Sim</button></a>
        </div>
        </div>
    </div>
    </div>
<tr class='row-tarefa'>
<td class='tarefa'>
<a href="/info_tarefa.php?=<?php echo $value['id_tarefa'] ?>"><?php echo $value['nome_tarefa']?></a> 
</td>
<td>
<a href="update.php?=<?php echo $value['id_tarefa']?>">
<img class = "button-alter" src="static/img/edit.svg" alt=""></a>
<a href="#"  class="button" data-toggle="modal" data-target="#exampleModal"><img class = "button-alter" src="static/img/delete.svg" alt=""></a>
</td>
</tr>

