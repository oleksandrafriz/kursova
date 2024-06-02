<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Stones;

class StonesController extends Controller
{
    public function actionIndex()
    {
        $stones = Stones::getAllStones();
        if (!$stones) {
            $this->addErrorMessage('No stones found');
        }

        $isAdmin = Core::get()->session->get('isAdmin', false);

        $this->render(['stones' => $stones, 'isAdmin' => $isAdmin]);
    }

    public function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $size = $_POST['size'];
            $image = file_get_contents($_FILES['image']['tmp_name']);

            $stoneData = [
                'name' => $name,
                'size' => $size,
                'image' => $image
            ];

            $result = Stones::addStone($stoneData);

            echo json_encode(['success' => $result > 0]);
            exit;
        } else {
            $this->render('add');
        }
    }

    public function actionUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $size = $_POST['size'] ?? 0;
            $image = $_FILES['image'] ?? null;

            $fieldsToUpdate = [
                'name' => $name,
                'size' => $size
            ];

            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $fileName = uniqid() . '_' . $image['name'];
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    $fieldsToUpdate['image'] = file_get_contents($filePath);
                }
            }

            $updated = Stones::updateStone((int)$id, $fieldsToUpdate);

            if ($updated) {
                $updatedStone = Stones::getStoneById((int)$id);
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'stone' => $updatedStone]);
                exit;
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Failed to update the stone.']);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        exit;
    }

    public function actionDelete($id)
    {
        $result = Stones::deleteStone($id);
        echo json_encode(['success' => $result]);
    }
}