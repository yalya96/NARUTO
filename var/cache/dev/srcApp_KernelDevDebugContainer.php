<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKHkOZmw\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKHkOZmw/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerKHkOZmw.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerKHkOZmw\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerKHkOZmw\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'KHkOZmw',
    'container.build_id' => 'dcd05d21',
    'container.build_time' => 1565806782,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerKHkOZmw');