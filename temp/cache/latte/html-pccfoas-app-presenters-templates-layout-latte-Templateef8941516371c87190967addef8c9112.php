<?php
// source: /var/www/html/pccfoas/app/presenters/templates/@layout.latte

class Templateef8941516371c87190967addef8c9112 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('fa82f292d1', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbc69549f2e4_head')) { function _lbc69549f2e4_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbddd418154e_title')) { function _lbddd418154e_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>		<h1>PCCF Office Automation!</h1>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbf269a398f7_scripts')) { function _lbf269a398f7_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//nette.github.io/resources/js/netteForms.min.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Sandbox</title>

	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css">
	<link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
	<meta name="viewport" content="width=device-width">
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>	
	<div id="banner">
<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>
	</div>
	<nav id="menu">
		<ul>
			<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:default"), ENT_COMPAT) ?>
">Home</a></li>
			<li><a href="#">Master Setting</a>
				<ul>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:mailSetting"), ENT_COMPAT) ?>
">Mail Setting</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:CurrencyFormat"), ENT_COMPAT) ?>
">Currency Setting</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:DateTimeSetting"), ENT_COMPAT) ?>
">Date & Time Setting</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:organization"), ENT_COMPAT) ?>
">Organization</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:usertype"), ENT_COMPAT) ?>
">User Type</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:wing"), ENT_COMPAT) ?>
">Wing</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:section"), ENT_COMPAT) ?>
">Section</a></li>
					<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Master:designation"), ENT_COMPAT) ?>
">Designation</a></li>
				</ul>
			</li>			
		</ul>
	</nav>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>	<div<?php if ($_l->tmp = array_filter(array('flash', $flash->type))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>
</body>
</html>
<?php
}}