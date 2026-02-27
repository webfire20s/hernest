<?php

function getDownlineUserIds($pdo, $userId) {

    $ids = [$userId];

    $stmt = $pdo->prepare("SELECT id FROM users WHERE parent_id = ?");
    $queue = [$userId];

    while (!empty($queue)) {
        $parent = array_shift($queue);

        $stmt->execute([$parent]);
        $children = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($children as $child) {
            $ids[] = $child;
            $queue[] = $child;
        }
    }

    return $ids;
}