<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

namespace Nette\Caching;


/**
 * Cache storage.
 */
interface IStorage
{

	/**
	 * Read from cache.
	 * @param  string key
	 * @return mixed|NULL
	 */
	function read($key);

	/**
	 * Prevents item reading and writing. Lock is released by write() or remove().
	 * @param  string key
	 * @return void
	 */
	function lock($key);

	/**
	 * Writes item into the cache.
	 * @param  string key
	 * @param  mixed  data
	 * @param  array  dependencies
	 * @return void
	 */
	function write($key, $data, array $dependencies);

	/**
	 * Removes item from the cache.
	 * @param  string key
	 * @return void
	 */
	function remove($key);

	/**
	 * Removes items from the cache by conditions.
	 * @param  array  conditions
	 * @return void
	 */
	function clean(array $conditions);

}
