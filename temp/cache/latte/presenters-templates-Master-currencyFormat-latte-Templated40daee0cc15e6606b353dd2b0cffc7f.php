<?php
// source: /var/www/html/pccfoas/app/presenters/templates/Master/currencyFormat.latte

class Templated40daee0cc15e6606b353dd2b0cffc7f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f3990d14b3', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb220df02fd4_content')) { function _lb220df02fd4_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="content">
	<h2>Manage Currency Format</h2>
	<div class="boxes">		
<?php $_l->tmp = $_control->getComponent("currencyFormat"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
<?php if ($datas) { ?>	<table id="data_table" border="1">
		<tr>
			<th>#</th>
			<th>Currency Name</th>
			<th>Symbol</th>
			<th>Appearance</th>
			<th>Created</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php $iterations = 0; foreach ($datas as $data) { ?>		<tr>
			<td><?php echo Latte\Runtime\Filters::escapeHtml(++$cnt, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->currency_name, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->symbol, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($data->appearance, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($data->created, 'd-m-Y'), ENT_NOQUOTES) ?></td>
			<td>
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("currencyFormatEdit", array($data->master_currency_format_id)), ENT_COMPAT) ?>
">Edit</a>
			</td>
			<td>
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("currencyFormatDelete", array($data->master_currency_format_id)), ENT_COMPAT) ?>
">Delete</a>
			</td>			
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
if (!function_exists($_b->blocks['scripts'][] = '_lb998e2035d1_scripts')) { function _lb998e2035d1_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ?>
<script src="https://files.nette.org/sandbox/jush.js"></script>
<script>
	jush.create_links = false;
	jush.highlight_tag('code');
	$('code.jush').each(function(){ $(this).html($(this).html().replace(/\x7B[/$\w].*?\}/g, '<span class="jush-latte">$&</span>')) });

	$('a[href^=#]').click(function(){
		$('html,body').animate({ scrollTop: $($(this).attr('href')).show().offset().top - 5 }, 'fast');
		return false;
	});
</script>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb43cddeb730_head')) { function _lb43cddeb730_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>



<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 
}}