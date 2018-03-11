<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Заголовок</th>
      <th scope="col">Тип</th>
      <th scope="col">Категория</th>
      <th scope="col">Наша стоимость</th>
      <th scope="col">Стоимость</th>
      <th scope="col">Риэлтор</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach($objects as $object) :?>
    <tr>
      <th scope="row"><?php _esc($object->object_id); ?></th>
      <td>
        <?php
          if($object->user_id === $user->id) { ?>
            <a href="/home/view?type=object&id=<?php _esc($object->object_id); ?>">
              <?php _esc($object->object_title); ?>
            </a>
        <?php
          } else {
            _esc($object->object_title);
          } ?>
      </td>
      <td><?php _esc($object->type_title); ?></td>
      <td><?php _esc($object->category_title); ?></td>
      <td><?php _esc($object->object_price); ?></td>
      <td><?php _esc($object->object_user_price); ?></td>
      <td><?php _esc($object->user_nickname); ?></td>
      <td>
        <?php
          if($object->user_id === $user->id) { ?>
            <a href="/home/edit?type=object&id=<?php _esc($object->object_id); ?>">Редактировать</a>
        <?php
          } else {
            _esc('Нет доступа');
          } ?>
      </td>
      <td>
        <?php
          if($object->user_id === $user->id) { ?>
            <a href="/home/delete?type=object&id=<?php _esc($object->object_id); ?>">Удалить</a>
        <?php
          } else {
            _esc('Нет доступа');
          } ?>
      </td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
