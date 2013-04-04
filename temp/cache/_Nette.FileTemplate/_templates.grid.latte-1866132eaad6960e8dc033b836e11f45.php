<?php //netteCache[01]000428a:2:{s:4:"time";s:21:"0.68603200 1365028304";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:105:"C:\Users\Daniel\Documents\GitHub\drifting\_admin\adminframework\components\NiftyGrid\templates\grid.latte";i:2;i:1365028248;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\_admin\adminframework\components\NiftyGrid\templates\grid.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'jlgntg9zzk')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block _
//
if (!function_exists($_l->blocks['_'][] = '_lb77808b3c37__')) { function _lb77808b3c37__($_l, $_args) { extract($_args); $_control->validateControl(false)
;if (!$control->isSubGrid): echo Nette\Templating\Helpers::escapeHtml($control['gridForm']->render('begin'), ENT_NOQUOTES) ?>

<?php endif ?>
<table class="grid"<?php echo Nette\Utils\Html::el(NULL, array('style' => $control->width ? 'width: '.$control->width.';':null))->attributes() ?>>
	<thead>
<?php if ($control->gridName): ?>		<tr>
			<th colspan="<?php echo htmlSpecialChars($colsCount) ?>" class="grid-name"><?php echo Nette\Templating\Helpers::escapeHtml($control->gridName, ENT_NOQUOTES) ?></th>
		</tr>
<?php endif ?>
		<tr class="grid-panel">
			<th colspan="<?php echo htmlSpecialChars($colsCount) ?>">
				<div class="grid-upper-panel">
<?php if ($control->hasGlobalButtons()): ?>					<div>
<?php $iterations = 0; foreach ($globalButtons as $globalButton): if (is_object($globalButton)) $_ctrl = $globalButton; else $_ctrl = $_control->getComponent($globalButton); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$iterations++; endforeach ?>
					</div>
<?php endif ?>
					<div class="grid-upper-info">
						<a class="grid-current-link" title="Získat odkaz na tuto stránku" href="<?php echo htmlSpecialChars($_control->link("this")) ?>
"></a>
						<div class="grid-results">
							celkem <?php echo Nette\Templating\Helpers::escapeHtml($results, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml(($results == 1) ? "záznam" : (($results >= 2 && $results <= 4) ? "záznamy" : "záznamů"), ENT_NOQUOTES) ;if ($paginate): ?>
 <?php if ((boolean)$results): ?>(Zobrazeno <?php echo Nette\Templating\Helpers::escapeHtml($viewedFrom, ENT_NOQUOTES) ?>
 až <?php echo Nette\Templating\Helpers::escapeHtml($viewedTo, ENT_NOQUOTES) ?>
)<?php endif ;endif ?>

						</div>
					</div>
				</div>
			</th>
		</tr>
<?php $iterations = 0; foreach ($flashes as $flash): ?>		<tr class="grid-flash <?php echo htmlSpecialChars($flash->type) ?>">
			<th colspan="<?php echo htmlSpecialChars($colsCount) ?>">
				<span><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></span>
				<div class="grid-flash-hide"></div>
			</th>
		</tr>
<?php $iterations++; endforeach ;$iterations = 0; foreach ($control['gridForm']->errors as $error): ?>		<tr class="grid-flash grid-error">
			<th colspan="<?php echo htmlSpecialChars($colsCount) ?>">
				<span><?php echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ?></span>
				<div class="grid-flash-hide"></div>
			</th>
		</tr>
<?php $iterations++; endforeach ?>
		<tr>
<?php if ($control->hasActionForm()): ?>			<th style="text-align:center; width: 16px;" class="grid-head-column"><input type="checkbox" class="grid-select-all" title="Označit/odznačit všechny záznamy" /></th>
<?php endif ;$iterations = 0; foreach ($subGrids as $subGrid): ?>			<th style="width: 26px;" class="grid-head-column"></th>
<?php $iterations++; endforeach ;$iterations = 0; foreach ($columns as $column): ?>
			<th class="grid-head-column"<?php echo Nette\Utils\Html::el(NULL, array('style' => $column->width ? 'width: '.$column->width.';':null))->attributes() ?>
><?php if ($control->hasEnabledSorting() && $column->isSortable()): $order = ($control->order == $column->name.' ASC') ? " DESC" : " ASC" ?>
<a class="grid-ajax" title="Obrátit řazení" href="<?php echo htmlSpecialChars($_control->link("this", array('order' => $column->name.$order))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($column->label, ENT_NOQUOTES) ?>
</a><?php else: echo Nette\Templating\Helpers::escapeHtml($column->label, ENT_NOQUOTES) ;endif ?>

<?php if ($column->isSortable() && $control->hasEnabledSorting()): ?>				<div class="grid-order">
					<a title="Řadit vzestupně" href="<?php echo htmlSpecialChars($_control->link("this", array('order' => $column->name.' ASC'))) ?>
"<?php if ($_l->tmp = array_filter(array('grid-ajax', 'grid-order-up' ,($control->order && ($control->order == $column->name.' ASC')) ? 'grid-order-active-up':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>></a>
					<a title="Řadit sestupně" href="<?php echo htmlSpecialChars($_control->link("this", array('order' => $column->name.' DESC'))) ?>
"<?php if ($_l->tmp = array_filter(array('grid-ajax', 'grid-order-down' ,($control->order && ($control->order == $column->name.' DESC')) ? 'grid-order-active-down':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>></a>
				</div>
<?php endif ?>
			</th>
<?php $iterations++; endforeach ;if ($control->hasButtons() || $control->hasFilterForm()): ?>			<th class="grid-head-column">Akce</th>
<?php endif ?>
		</tr>
<?php if ($control->hasFilterForm()): ?>		<tr>
<?php if ($control->hasActionForm()): ?>			<th class="grid-filter-form"></th>
<?php endif ;$iterations = 0; foreach ($subGrids as $subGrid): ?>			<th class="grid-filter-form"></th>
<?php $iterations++; endforeach ;$iterations = 0; foreach ($columns as $column): ?>
			<th<?php echo Nette\Utils\Html::el(NULL, array('class' => array('grid-filter-form', $control->isSpecificFilterActive($column->name) ? 'grid-filter-form-active':null)))->attributes() ?>>
<?php if ($column->hasFilter()): ?>
					<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['filter'][$column->name]->getControl(), ENT_NOQUOTES) ?>

<?php endif ?>
			</th>
<?php $iterations++; endforeach ?>
			<th class="grid-filter-form"><?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['filter']['send']->getControl(), ENT_NOQUOTES) ;if ($control->hasActiveFilter()): ?>
<a title="Zrušit filtr" class="grid-filter-reset grid-ajax" href="<?php echo htmlSpecialChars($_control->link("this", array('filter' => NULL, 'paginator-page' => NULL))) ?>
"></a><?php endif ?>
</th>
		</tr>
<?php endif ?>
	</thead>
	<tbody>
<?php if ($control->showAddRow && $control->isEditable()): ?>		<tr>
<?php if ($control->hasActionForm()): ?>			<td class="grid-row-cell grid-edited-cell"></td>
<?php endif ;if (count($subGrids)): ?>			<td colspan="count($subGrids)" class="grid-row-cell grid-edited-cell"></td>
<?php endif ;$iterations = 0; foreach ($columns as $column): ?>			<td class="grid-row-cell grid-data-cell grid-edited-cell">
<?php if ($column->editable): ?>
					<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['rowForm'][$column->name]->getControl(), ENT_NOQUOTES) ?>

<?php endif ?>
			</td>
<?php $iterations++; endforeach ?>
			<td class="grid-row-cell grid-edited-cell">
				<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['rowForm']['send']->getControl(), ENT_NOQUOTES) ?>

				<a class="grid-rowForm-cancel grid-ajax" title="Zrušit editaci" href="<?php echo htmlSpecialChars($_control->link("this")) ?>
"></a>
			</td>
		</tr>
<?php endif ;if (count($rows)): $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($rows) as $row): ?>
		<tr<?php echo Nette\Utils\Html::el(NULL, array('class' => $iterator->isOdd() ? 'grid-row-odd' : 'grid-row-even'))->attributes() ?>>
<?php if ($control->hasActionForm()): ?>			<td<?php echo Nette\Utils\Html::el(NULL, array('class' => array('grid-row-cell', 'grid-action-checkbox', $control->isEditable() && $control->activeRowForm == $row[$primaryKey] ? 'grid-edited-cell':null)))->attributes() ?>
><?php echo Nette\Templating\Helpers::escapeHtml($control->assignCheckboxToRow($row[$primaryKey]), ENT_NOQUOTES) ?></td>
<?php endif ;$iterations = 0; foreach ($subGrids as $subgrid): ?>			<td<?php echo Nette\Utils\Html::el(NULL, array('class' => array('grid-row-cell', $control->isEditable() && $control->activeRowForm == $row[$primaryKey] ? 'grid-edited-cell':null)))->attributes() ?>>
<?php if (is_object($subgrid)) $_ctrl = $subgrid; else $_ctrl = $_control->getComponent($subgrid); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render($row) ?>
			</td>
<?php $iterations++; endforeach ;$iterations = 0; foreach ($columns as $column): ?>
			<td<?php echo Nette\Utils\Html::el(NULL, array('class' => array('grid-row-cell', 'grid-data-cell', $control->isEditable() && $control->activeRowForm == $row[$primaryKey] ? 'grid-edited-cell':null), 'style' => $column->hasCellRenderer() ? $column->getCellRenderer($row):null))->attributes() ?>>
<?php if ($control->isEditable() && $column->editable && $control->activeRowForm == $row[$primaryKey]): ?>
					<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['rowForm'][$column->name]->getControl(), ENT_NOQUOTES) ?>

<?php else: ?>
					<?php echo Nette\Templating\Helpers::escapeHtml($column->prepareValue($row), ENT_NOQUOTES) ?>

<?php endif ?>
			</td>
<?php $iterations++; endforeach ;if ($control->hasButtons() || $control->hasFilterForm()): ?>
			<td<?php echo Nette\Utils\Html::el(NULL, array('class' => array('grid-row-cell', $control->isEditable() && $control->activeRowForm == $row[$primaryKey] ? 'grid-edited-cell':null)))->attributes() ?>>
<?php if ($control->activeRowForm == $row[$primaryKey] && $control->isEditable()): ?>
					<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['rowForm']['send']->getControl(), ENT_NOQUOTES) ?>

					<a class="grid-rowForm-cancel grid-ajax" title="Zrušit editaci" href="<?php echo htmlSpecialChars($_control->link("this")) ?>
"></a>
					<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['rowForm'][$primaryKey]->getControl(), ENT_NOQUOTES) ?>

<?php else: $iterations = 0; foreach ($buttons as $button): if (is_object($button)) $_ctrl = $button; else $_ctrl = $_control->getComponent($button); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render($row) ;$iterations++; endforeach ;endif ?>
			</td>
<?php endif ?>
		</tr>
<?php if ($control->hasActiveSubGrid() && $control->activeSubGridId == $row[$primaryKey]): ?>		<tr class="grid-subgrid-row" align="center">
			<td colspan="<?php echo htmlSpecialChars($colsCount) ?>"<?php echo Nette\Utils\Html::el(NULL, array('style' => $control['subGrids-'.$control->activeSubGridName]->hasCellStyle() ? $control['subGrids-'.$control->activeSubGridName]->getCellStyle().'border-bottom:1px solid #f2f2f2;':null))->attributes() ?>>
<?php if (is_object($control['subGrid'.$control->activeSubGridName])) $_ctrl = $control['subGrid'.$control->activeSubGridName]; else $_ctrl = $_control->getComponent($control['subGrid'.$control->activeSubGridName]); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
			</td>
		</tr>
<?php endif ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;else: ?>
		<tr>
			<td class="grid-row-cell" style="background-color:#FFF; font-size:16px;" colspan="<?php echo htmlSpecialChars($colsCount) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($control->messageNoRecords, ENT_NOQUOTES) ?></td>
		</tr>
<?php endif ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="<?php echo htmlSpecialChars($colsCount) ?>" class="grid-bottom">
<?php if ($control->hasActionForm()): ?>				<span class="grid-action-box">
						<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['action']['action_name']->label, ENT_NOQUOTES) ?>

						<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['action']['action_name']->getControl(), ENT_NOQUOTES) ?>

						<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['action']['send']->getControl(), ENT_NOQUOTES) ?>

				</span>
<?php endif ;if ($paginate): ?>				<span class="grid-perPage">
						<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['perPage']['perPage']->label, ENT_NOQUOTES) ?>

						<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['perPage']['perPage']->getControl(), ENT_NOQUOTES) ?>

						<?php echo Nette\Templating\Helpers::escapeHtml($control['gridForm'][$control->name]['perPage']['send']->getControl(), ENT_NOQUOTES) ?>

				</span>
<?php endif ?>
			</td>
		</tr>
<?php if ($paginate): ?>		<tr class="grid-panel">
			<td colspan="<?php echo htmlSpecialChars($colsCount) ?>">
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
			</td>
		</tr>
<?php endif ?>
	</tfoot>
</table>
<?php if (!$control->isSubGrid): echo Nette\Templating\Helpers::escapeHtml($control['gridForm']->render('end'), ENT_NOQUOTES) ?>

<?php endif ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>
<div id="<?php echo $_control->getSnippetId('') ?>"><?php call_user_func(reset($_l->blocks['_']), $_l, $template->getParameters()) ?>
</div>
