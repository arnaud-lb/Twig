<?php

/*
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a template filter.
 *
 * @package    twig
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
abstract class Twig_Filter implements Twig_FilterInterface
{
    protected $options;

    public function __construct(array $options = array())
    {
        $this->options = array_merge(array(
            'needs_environment' => false,
        ), $options);

        if (isset($this->options['is_escaper'])) {
            throw new InvalidArgumentException("Invalid option is_escaper, use is_safe instead");
        }
    }

    public function needsEnvironment()
    {
        return $this->options['needs_environment'];
    }

    public function isSafe($for, Twig_Node $filterArgs)
    {
        if (isset($this->options['is_safe'])) {
            return in_array($for, $this->options['is_safe']);
        }
        if (isset($this->options['is_safe_callback'])) {
            return call_user_func($this->options['is_safe_callback'], $for, $filterArgs);
        }
        return false;
    }
}
