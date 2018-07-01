<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 18.01.2018
 * Time: 14:45
 */

namespace common\addons\giiant;

use common\addons\giiant\generators\crud\Generator;
use schmunk42\giiant\commands\BatchController;
use common\addons\giiant\generators\model\Generator as ModelGenerator;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

class CBatchController extends BatchController
{
    /**
     * @var bool whether to use or not 2amigos/yii2-translateable-behavior
     */
    public $useThumbnailBehaviour = false;

    /**
     * @var bool whether to use or not 2amigos/yii2-translateable-behavior
     */
    public $useImagesBehaviour = true;

    /**
     * {@inheritdoc}
     */
    public function options($id)
    {
        return array_merge(
            parent::options($id),
            [
                'template',
                'overwrite',
                'useTimestampBehavior',
                'createdAtColumn',
                'updatedAtColumn',
                'useTranslatableBehavior',
                'languageTableName',
                'languageCodeColumn',
                'useBlameableBehavior',
                'createdByColumn',
                'updatedByColumn',
                'extendedModels',
                'enableI18N',
                'messageCategory',
                'singularEntities',
                'tables',
                'tablePrefix',
                'modelDb',
                'modelNamespace',
                'modelBaseClass',
                'modelBaseTraits',
                'modelBaseClassSuffix',
                'modelRemoveDuplicateRelations',
                'modelGenerateRelations',
                'modelGenerateQuery',
                'modelQueryNamespace',
                'modelQueryBaseClass',
                'modelGenerateLabelsFromComments',
                'modelGenerateHintsFromComments',
                'crudTidyOutput',
                'crudFixOutput',
                'crudControllerNamespace',
                'crudSearchModelNamespace',
                'crudSearchModelSuffix',
                'crudViewPath',
                'crudPathPrefix',
                'crudProviders',
                'crudSkipRelations',
                'crudBaseControllerClass',
                'crudAccessFilter',
                'crudTemplate',
            ]
        );
    }

    public function actionUpdate()
    {
        echo "Running full giiant batch...\n";
        $this->actionModels();
    }


    /**
     * Run batch process to generate models all given tables.
     *
     * @throws \yii\console\Exception
     */
    public function actionModels()
    {
        // create models
        foreach ($this->tables as $table) {
            //var_dump($this->tableNameMap, $table);exit;
            $params = [
                'interactive' => $this->interactive,
                'overwrite' => $this->overwrite,
                'useTimestampBehavior' => $this->useTimestampBehavior,
                'createdAtColumn' => $this->createdAtColumn,
                'updatedAtColumn' => $this->updatedAtColumn,
                'useTranslatableBehavior' => $this->useTranslatableBehavior,
                'languageTableName' => $this->languageTableName,
                'languageCodeColumn' => $this->languageCodeColumn,
                'useBlameableBehavior' => $this->useBlameableBehavior,
                'createdByColumn' => $this->createdByColumn,
                'updatedByColumn' => $this->updatedByColumn,
                'template' => $this->template,
                'ns' => $this->modelNamespace,
                'db' => $this->modelDb,
                'tableName' => $table,
                'tablePrefix' => $this->tablePrefix,
                'enableI18N' => $this->enableI18N,
                'singularEntities' => $this->singularEntities,
                'messageCategory' => $this->modelMessageCategory,
                'generateModelClass' => $this->extendedModels,
                'baseClassSuffix' => $this->modelBaseClassSuffix,
                'modelClass' => isset($this->tableNameMap[$table]) ?
                    $this->tableNameMap[$table] :
                    Inflector::camelize($table),
                'baseClass' => $this->modelBaseClass,
                'baseTraits' => $this->modelBaseTraits,
                'removeDuplicateRelations' => $this->modelRemoveDuplicateRelations,
                'generateRelations' => $this->modelGenerateRelations,
                'tableNameMap' => $this->tableNameMap,
                'generateQuery' => $this->modelGenerateQuery,
                'queryNs' => $this->modelQueryNamespace,
                'queryBaseClass' => $this->modelQueryBaseClass,
                'generateLabelsFromComments' => $this->modelGenerateLabelsFromComments,
                'generateHintsFromComments' => $this->modelGenerateHintsFromComments,
            ];
            $route = 'gii/custom_model';

            $app = \Yii::$app;
            $temp = new \yii\console\Application($this->appConfig);
            $temp->runAction(ltrim($route, '/'), $params);
            unset($temp);
            \Yii::$app = $app;
            \Yii::$app->log->logger->flush(true);
        }
    }

    /**
     * Run batch process to generate CRUDs all given tables.
     *
     * @throws \yii\console\Exception
     */
    public function actionCruds()
    {
        // create CRUDs
        $providers = ArrayHelper::merge($this->crudProviders, Generator::getCoreProviders());

        // create folders
        $this->createDirectoryFromNamespace($this->crudControllerNamespace);
        $this->createDirectoryFromNamespace($this->crudSearchModelNamespace);

        foreach ($this->tables as $table) {
            $table = str_replace($this->tablePrefix, '', $table);
            $name = isset($this->tableNameMap[$table]) ? $this->tableNameMap[$table] :
                $this->modelGenerator->generateClassName($table);
            $params = [
                'interactive' => $this->interactive,
                'overwrite' => $this->overwrite,
                'template' => $this->template,
                'modelClass' => $this->modelNamespace.'\\'.$name,
                'searchModelClass' => $this->crudSearchModelNamespace.'\\'.$name.$this->crudSearchModelSuffix,
                'controllerNs' => $this->crudControllerNamespace,
                'controllerClass' => $this->crudControllerNamespace.'\\'.$name.'Controller',
                'viewPath' => $this->crudViewPath,
                'pathPrefix' => $this->crudPathPrefix,
                'tablePrefix' => $this->tablePrefix,
                'enableI18N' => $this->enableI18N,
                'singularEntities' => $this->singularEntities,
                'messageCategory' => $this->crudMessageCategory,
                'modelMessageCategory' => $this->modelMessageCategory,
                'actionButtonClass' => 'yii\\grid\\ActionColumn',
                'baseControllerClass' => $this->crudBaseControllerClass,
                'providerList' => $providers,
                'skipRelations' => $this->crudSkipRelations,
                'accessFilter' => $this->crudAccessFilter,
                'baseTraits' => $this->crudBaseTraits,
                'tidyOutput' => $this->crudTidyOutput,
                'fixOutput' => $this->crudFixOutput,
                'template' => $this->crudTemplate,
                'indexWidgetType' => $this->crudIndexWidgetType,
                'indexGridClass' => $this->crudIndexGridClass,
            ];
            $route = 'gii/custom_crud';
            $app = \Yii::$app;
            $temp = new \yii\console\Application($this->appConfig);
            $temp->runAction(ltrim($route, '/'), $params);
            unset($temp);
            \Yii::$app = $app;
            \Yii::$app->log->logger->flush(true);
        }
    }

    /**
     * Helper function to create.
     *
     * @param $ns Namespace
     */
    private function createDirectoryFromNamespace($ns)
    {
        echo \Yii::getRootAlias($ns);
        $dir = \Yii::getAlias('@'.str_replace('\\', '/', ltrim($ns, '\\')));
        @mkdir($dir);
    }

    public function beforeAction($action)
    {
        $this->appConfig = $this->getYiiConfiguration();
        $this->appConfig['id'] = 'temp';
        $this->modelGenerator = new ModelGenerator(['db' => $this->modelDb]);

        if (!$this->tables) {
            $this->modelGenerator->tableName = '*';
            $this->tables = $this->modelGenerator->getTableNames();
            $tableList = implode("\n\t- ", $this->tables);
            $msg = "Are you sure that you want to run action \"{$action->id}\" for the following tables?\n\t- {$tableList}\n\n";
            if (!$this->confirm($msg)) {
                return false;
            }
        }

        return parent::beforeAction($action);
    }
}