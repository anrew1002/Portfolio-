<tr id='<?php echo e($discription['id']); ?>'>
    <td class="<?= $discription['done']==1 ? 'curltl': ''?>"> <?php echo e($discription['type']);  ?></td>
    <td><?= e($discription['name']); ?> </td>
    <td><?= e($discription['place']); ?></td>
    <td><?= e($discription['date']); ?> <a class='edit_btn' href="task.php?id=<?= e($discription['id']); ?>"></a></td>

</tr>