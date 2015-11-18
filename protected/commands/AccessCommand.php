<?php
class AccessCommand extends CConsoleCommand
{
    public function actionAddRules() {
    $auth=Yii::app()->authManager;

    $auth->createOperation('addCard','create card');
    $auth->createOperation('viewCard','view card');
    $auth->createOperation('updateCard','update card');
    $auth->createOperation('deleteCard','delete card');
    $auth->createOperation('viewCards','view cards');

    $auth->createOperation('addUser','create user');
    $auth->createOperation('viewUser','view user');
    $auth->createOperation('updateUser','update user');
    $auth->createOperation('deleteUser','delete user');
    $auth->createOperation('viewUsers','view users');

    $bizRule='return Yii::app()->user->user_id==$params["card"]->owner_id;';
    $task=$auth->createTask('viewOwnCard', 'view own card', $bizRule);
    $task->addChild('viewCard');
    $task=$auth->createTask('updateOwnCard', 'edit own card', $bizRule);
    $task->addChild('updateCard');
    $task=$auth->createTask('deleteOwnCard', 'delete own card', $bizRule);
    $task->addChild('deleteCard');

    $role=$auth->createRole('user');
    $role->addChild('addCard');
    $role->addChild('viewOwnCard');
    $role->addChild('updateOwnCard');
    $role->addChild('deleteOwnCard');
    $role->addChild('viewCards');

    $role=$auth->createRole('admin');
    $role->addChild('user');
    $role->addChild('addUser');
    $role->addChild('viewUser');
    $role->addChild('updateUser');
    $role->addChild('deleteUser');
    $role->addChild('viewUsers');
}

    public function actionAddAdminUser() {
        $auth=Yii::app()->authManager;

        $user = new User();
        $user->username = 'admin';
        $user->password = 'admin';
        $user->email = 'admin@site.loc';
        $user->role = 'admin';
        $user->save();
    }
}