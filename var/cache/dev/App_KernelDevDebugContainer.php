<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerWcduSVW\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerWcduSVW/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerWcduSVW.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerWcduSVW\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerWcduSVW\App_KernelDevDebugContainer([
    'container.build_hash' => 'WcduSVW',
    'container.build_id' => '1724db65',
    'container.build_time' => 1679044445,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerWcduSVW');
