<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerQECxGAc\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerQECxGAc/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerQECxGAc.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerQECxGAc\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerQECxGAc\App_KernelDevDebugContainer([
    'container.build_hash' => 'QECxGAc',
    'container.build_id' => '036f6385',
    'container.build_time' => 1681211510,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerQECxGAc');
