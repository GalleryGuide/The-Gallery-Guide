<?php
// $Id: search-result.tpl.php,v 1.1.2.1 2008/08/28 08:21:44 dries Exp $

/**
 * @file search-result.tpl.php
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $type: The type of search, e.g., "node" or "user".
 *
 * Default keys within $info_split:
 * - $info_split['type']: Node type.
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 * - $info_split['upload']: Number of attachments output as "% attachments", %
 *   being the count. Depends on upload.module.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for their existance before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 *
 *   <?php if (isset($info_split['comment'])) : ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 *
 * To check for all available data within $info_split, use the code below.
 *
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 *
 * @see template_preprocess_search_result()
 */
?>
<div class="search-result">
   <div class="image">
      <?php
      if (isset($node->field_images[0]))
              $image = theme('imagecache', 'thumb', $node->field_images[0]['filepath']);
      else $image = '<img src="/sites/default/files/imagecache/thumb/imagefield_default_images/anon_large_0.gif"/>';
      ?>
            <a href="<?php print $url; ?>"><?php print $image;?>
            </a>
   </div>
   <div class="body">
      <div class="title">
        <a href="<?php print $url; ?>"><?php print $title; ?></a>
      </div>
      <?php 
      if($node->type == 'gallery'):
           echo $node->locations[0]['street']. '<br/>';
            echo $node->locations[0]['postal_code'] . '<br/>';
            echo $node->locations[0]['phone']. '<br/>';

      elseif($node->type == 'exhibition'):
         $gallery = node_load($node->field_exhib_gallery[0]['nid']);
         echo $gallery->title .', ' . date('j M Y', strtotime($node->field_exhib_dates[0]['value'])). ' - '. date('j M Y', strtotime($node->field_exhib_dates[0]['value2']));
      endif;?>
        <?php if ($snippet) :?>
         <div class="text">
          <?php print $snippet; ?>
         </div>
        <?php endif; ?>
   </div>
</div>