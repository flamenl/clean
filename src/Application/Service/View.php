<?php

declare(strict_types=1);

namespace Application\Service;

class View
{
    /**
     * When the template calls $this->something(), we can provide a response here (or delegate it elsewhere).
     */
    public function __call(string $name, array $arguments)
    {
        if ($name === 'render') {
            // Prevent recursion.
            throw new \Exception('This is a reserved function.');
        }
        return 'helper not implemented';
    }

    public function render(string $template = '', array $___variables = [])
    {
        $___file = realpath(__DIR__ . '/../../../templates') . '/' . $template;
        return (function () use ($___file, $___variables) {
            ob_start();
            foreach ($___variables as $key => $value) {
                $$key = $value;
            }
            include $___file;
            return ob_get_clean();
        })();
    }
}
