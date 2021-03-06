<?php
// source: /var/www/html/pccfoas/app/presenters/templates/Master/wing.latte

class Template929ad6a6a80bb10a786862fcb600bab3 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('82fbc754ae', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe2ac15098f_content')) { function _lbe2ac15098f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="content">
	<h2>Manage Wing</h2>
	<div class="boxes">		
<?php $_l->tmp = $_control->getComponent("wing"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
<?php if ($datas) { ?>	<table id="data_table" border="1">
		<tr>
			<th>#</th>
			<th>Wing Name</th>
			<th>Wing Head</th>
			<th>Parent</th>
			<th>Created</th>			
			<th>Action</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php $iterations = 0; foreach ($datas as $data) { ?>		<tr>
			<td><?php echo Latte\Runtime\Filters::escapeHtml(++$cnt, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->name, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->wing_head, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->parent_id, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($data->created, 'd-m-Y'), ENT_NOQUOTES) ?></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("wingAction", array($data->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml(($data->is_enable == 1)?'Disable':'Enable', ENT_NOQUOTES) ?></a></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("wingEdit", array($data->id)), ENT_COMPAT) ?>
">Edit</a></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("wingDelete", array($data->id)), ENT_COMPAT) ?>
">Delete</a></td>			
		</tr>
<?php $iterations++; } ?>
	</table>		
<?php } ?>
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbd79cecd677_scripts')) { function _lbd79cecd677_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb3e577f88b1_head')) { function _lb3e577f88b1_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 
}}