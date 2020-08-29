<?php

/**
 * Get the evaluated view contents for the given view.
 *
 * @param  string  $view
 * @param  array   $data
 * @return League\Plates\Engine
 */
function view($view, $data = [])
{
	$plates = League\Plates\Engine::create('resources/views', 'php');
	$plates->addConfig([
	    'render_context_var_name' => 'template',
	]);
    echo $plates->render($view, $data);
}

/**
 * Insert layout inside file.
 *
 * @param  League\Plates\Engine $instance
 * @param  string $layout
 * @param  array $data
 * @return League\Plates\Template\Template
 */
function layout($instance, $layout, $data = [])
{
	$instance->layout($layout, $data);
	return $instance->layout($layout, $data);
}

/**
 * Start a section of template.
 *
 * @param  League\Plates\Template\Template $instance
 * @param  string $name
 * @return League\Plates\Template\Template
 */
function start($instance, $name)
{
	return $instance->start($name);
}

/**
 * Stop a section of template.
 *
 * @param  League\Plates\Template\Template $instance
 * @return League\Plates\Template\Template
 */
function stop($instance)
{
	return $instance->stop();
}

/**
 * Print a section in template.
 *
 * @param  League\Plates\Template\Template $instance
 * @param  string $name
 * @return void
 */
function section($instance, $name)
{
	echo $instance->section($name);
}

/**
 * Insert view inside view
 *
 * @param League\Plates\Template\Template $instance
 * @param string $view
 * @param array $data
 * @return void
 */
function insert($instance, $view, $data = [])
{
	$instance->insert($name, $data);
}
