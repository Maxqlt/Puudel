<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container6vwxaux\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container6vwxaux/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container6vwxaux.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container6vwxaux\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container6vwxaux\App_KernelDevDebugContainer([
    'container.build_hash' => '6vwxaux',
    'container.build_id' => '4271ec97',
    'container.build_time' => 1679579138,
], __DIR__.\DIRECTORY_SEPARATOR.'Container6vwxaux');
