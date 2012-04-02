<?php
// $Id: views-view-table.tpl.php,v 1.8 2009/01/28 00:43:43 merlinofchaos Exp $
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * @ingroup views_templates
 */
?>
  <?php if (!empty($title)) : ?>
    <h3><caption><?php print $title; ?></caption></h3>
  <?php endif; ?>

      <?php foreach ($header as $field => $label): ?>
          <?php print $label; ?>
      <?php endforeach; ?>

    <?php foreach ($rows as $count => $row): ?>
    <div class="row">
        <?php foreach ($row as $field => $content): ?>
            <div class="column"><?php print $content; ?></div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>