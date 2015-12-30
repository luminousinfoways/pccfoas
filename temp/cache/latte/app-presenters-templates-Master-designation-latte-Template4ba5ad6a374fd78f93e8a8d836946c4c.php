<?php
// source: /var/www/html/pccfoas/app/presenters/templates/Master/designation.latte

class Template4ba5ad6a374fd78f93e8a8d836946c4c extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('bd87b2d93e', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd6aec587ac_content')) { function _lbd6aec587ac_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="content">
	<h2>Manage Designation</h2>
	<div class="boxes">		
<?php $_l->tmp = $_control->getComponent("designation"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
<?php if ($datas) { ?>	<table id="data_table" border="1">
		<tr>
			<th>#</th>
			<th>Designation</th>
			<th>Section</th>
			<th>Created</th>
			<th>Action</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php $iterations = 0; foreach ($datas as $data) { ?>		<tr>
			<td><?php echo Latte\Runtime\Filters::escapeHtml(++$cnt, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->name, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->section_id, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($data->created, 'd/m/Y'), ENT_NOQUOTES) ?></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("designationAction", array($data->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml(($data->is_enable == 1)?'Disable':'Enable', ENT_NOQUOTES) ?></a></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("designationEdit", array($data->id)), ENT_COMPAT) ?>
">Edit</a></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("designationDelete", array($data->id)), ENT_COMPAT) ?>
">Delete</a></td>			
		</tr>
<?php $iterations++; } ?>
	</table>		
<?php } ?>
</div>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}