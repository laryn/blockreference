<?php

/**
 * @file
 * Documents Block reference's hooks for api reference.
 */

/**
 * Alter referenceable blocks.
 *
 * These are always block objects, not options. You can change the option label by changing $block->info.
 *
 * For autocomplete fields, this alter happens AFTER the search, before slicing the results (ACDB does that).
 *
 * $context contains:
 * - instance
 * - type ("autocomplete" or "options_list", depending on where this list is requested)
 * - entity
 * - entity_type
 */
function hook_blockreference_blocks_alter(&$blocks, $context) {
  foreach ($blocks as $id => $block) {
    // Add module & delta to pretty label.
    $block->info .= ' (' . $block->module . '/' . $block->delta . ')';

    // Remove all Views blocks, except 'public_stuff'.
    if ($block->module == 'views' && strpos($block->delta, 'public_stuff-') !== 0) {
      unset($blocks[$id]);
    }
  }
}
