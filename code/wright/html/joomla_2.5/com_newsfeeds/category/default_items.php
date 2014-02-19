<?php
// Wright v.3 Override: Joomla 2.5.17
/**
 * @package		Joomla.Site
 * @subpackage	com_newsfeeds
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.framework');

$n			= count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?>	 </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">  <?php // Wright v.3: Added form-inline class ?>
	<fieldset class="filters well well-small">  <?php // Wright v.3: Added well well-small classes ?>
	<legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
	<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	<?php endif; ?>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	</fieldset>
	<table class="category table table-striped table-hover">    <?php // Wright v.3: Added table table-striped table-hover classes ?>
		<?php if ($this->params->get('show_headings')==1) : ?>
		<thead><tr>

				<th class="item-title" id="tableOrdering">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_FEED_NAME', 'a.name', $listDirn, $listOrder); ?>
				</th>


				<?php if ($this->params->get('show_articles')) : ?>
				<th class="item-num-art" id="tableOrdering2">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_NUM_ARTICLES', 'a.numarticles', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

				<?php if ($this->params->get('show_link')) : ?>
				<th class="item-link" id="tableOrdering3">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_FEED_LINK', 'a.link', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
		<?php if ($this->items[$i]->published == 0) : ?>
			<tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
		<?php else: ?>
			<tr class="cat-list-row<?php echo $i % 2; ?>" >
		<?php endif; ?>

					<td class="item-title">
						<a href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($item->slug, $item->catid)); ?>">
							<?php echo $item->name; ?></a>
					</td>

					<?php  if ($this->params->get('show_articles')) : ?>
						<td class="item-num-art">
							<?php echo $item->numarticles; ?>
						</td>
					<?php  endif; ?>

					<?php  if ($this->params->get('show_link')) : ?>
						<td class="item-link">
							<a href="<?php echo $item->link; ?>"><?php echo $item->link; ?></a>
						</td>
					<?php  endif; ?>

				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>

	<?php if ($this->params->get('show_pagination')) : ?>
	<div class="divpagination">
	<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	<?php endif; ?>
	<?php echo wrightTransformArticlePagination($this->pagination->getPagesLinks());  // Wright v.3: Page Navigation transformation (using helper) ?>
	</div>
	<?php endif; ?>

</form>
<?php endif; ?>