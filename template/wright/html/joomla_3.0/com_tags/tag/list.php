<?php
// Wright v.3 Override: Joomla 3.2.2
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
// Note that there are certain parts of this layout used only when there is exactly one tag.

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
$n = count($this->items);
?>
<div class="tag-category<?php echo $this->pageclass_sfx; ?>">
<?php  if ($this->params->get('show_page_heading')) : ?>
<div class="page-header">  <?php // Wright v.3: Added page header ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
</div>  <?php // Wright v.3: Added page header ?>
<?php endif;  ?>
<?php if($this->params->get('show_tag_title', 1)) : ?>

<?php /* Wright v.3: Adds page header if h1 is missing */
if (!$this->params->get('show_page_heading')) : ?>
<div class="page-header">
<?php endif; /* End Wright v.3: Adds page header if h1 is missing */ ?>

<h2>
	<?php echo JHtml::_('content.prepare', $this->document->title, '', 'com_tag.tag'); ?>
</h2>

<?php /* Wright v.3: Adds page header if h1 is missing */
if (!$this->params->get('show_page_heading')) : ?>
</div>
<?php endif; /* End Wright v.3: Adds page header if h1 is missing */ ?>

<?php endif; ?>
<?php // We only show a tag description if there is a single tag. ?>
<?php  if (count($this->item) == 1 && (($this->params->get('tag_list_show_tag_image', 1)) || $this->params->get('tag_list_show_tag_description', 1))) : ?>
	<div class="category-desc">
	<?php  $images  = json_decode($this->item[0]->images); ?>
	<?php  if ($this->params->get('tag_list_show_tag_image', 1) == 1 && !empty($images->image_fulltext)) :?>
		<img src="<?php echo htmlspecialchars($images->image_fulltext);?>">
	<?php endif; ?>
	<?php if ($this->params->get('tag_list_show_tag_description') == 1 && $this->item[0]->description) : ?>
		<?php echo JHtml::_('content.prepare', $this->item[0]->description, '', 'com_tags.tag'); ?>
	<?php endif; ?>
	<div class="clr"></div>
	</div>
<?php endif; ?>
<?php // If there are multiple tags and a description or image has been supplied use that. ?>
<?php if ($this->params->get('tag_list_show_tag_description', 1) || $this->params->get('show_description_image', 1)): ?>
		<?php  if ($this->params->get('show_description_image', 1) == 1 && $this->params->get('tag_list_image')) :?>
			<img src="<?php echo $this->params->get('tag_list_image');?>">
		<?php endif; ?>
		<?php if ($this->params->get('tag_list_description', '') > '') :?>
			<?php echo JHtml::_('content.prepare', $this->params->get('tag_list_description'), '', 'com_tags.tag'); ?>
		<?php endif; ?>

<?php endif; ?>

<?php echo $this->loadTemplate('items'); ?>
