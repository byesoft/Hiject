<?php

/*
 * This file is part of Hiject.
 *
 * Copyright (C) 2016 Hiject Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hiject\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Hiject\Core\ObjectStorage\FileStorage;
use Hiject\Core\Paginator;
use Hiject\Core\Http\OAuth2;
use Hiject\Core\Tool;
use Hiject\Core\Http\Client as HttpClient;

/**
 * Class ClassProvider
 */
class ClassProvider implements ServiceProviderInterface
{
    private $classes = array(
        'Analytic' => array(
            'TaskDistributionAnalytic',
            'UserDistributionAnalytic',
            'EstimatedTimeComparisonAnalytic',
            'AverageLeadCycleTimeAnalytic',
            'AverageTimeSpentColumnAnalytic',
        ),
        'Model' => array(
            'ActionModel',
            'ActionParameterModel',
            'AvatarFileModel',
            'BoardModel',
            'CategoryModel',
            'ColorModel',
            'ColumnModel',
            'ColumnRestrictionModel',
            'ColumnMoveRestrictionModel',
            'CommentModel',
            'ConfigModel',
            'CurrencyModel',
            'CustomFilterModel',
            'GroupModel',
            'GroupMemberModel',
            'LanguageModel',
            'LastLoginModel',
            'LinkModel',
            'NotificationModel',
            'PasswordResetModel',
            'ProjectModel',
            'ProjectFileModel',
            'ProjectActivityModel',
            'ProjectDuplicationModel',
            'ProjectDailyColumnStatsModel',
            'ProjectDailyStatsModel',
            'ProjectPermissionModel',
            'ProjectNotificationModel',
            'ProjectMetadataModel',
            'ProjectGroupRoleModel',
            'ProjectRoleModel',
            'ProjectRoleRestrictionModel',
            'ProjectTaskDuplicationModel',
            'ProjectTaskPriorityModel',
            'ProjectUserRoleModel',
            'RememberMeSessionModel',
            'SubtaskModel',
            'SubtaskPositionModel',
            'SubtaskStatusModel',
            'SubtaskTaskConversionModel',
            'SubtaskTimeTrackingModel',
            'SwimlaneModel',
            'TagDuplicationModel',
            'TagModel',
            'TaskModel',
            'TaskAnalyticModel',
            'TaskCreationModel',
            'TaskDuplicationModel',
            'TaskProjectDuplicationModel',
            'TaskProjectMoveModel',
            'TaskRecurrenceModel',
            'TaskExternalLinkModel',
            'TaskFinderModel',
            'TaskFileModel',
            'TaskLinkModel',
            'TaskModificationModel',
            'TaskPositionModel',
            'TaskStatusModel',
            'TaskTagModel',
            'TaskMetadataModel',
            'TimezoneModel',
            'TransitionModel',
            'UserModel',
            'UserLockingModel',
            'UserMentionModel',
            'UserNotificationModel',
            'UserNotificationFilterModel',
            'UserUnreadNotificationModel',
            'UserMetadataModel',
        ),
        'Validator' => array(
            'ActionValidator',
            'AuthValidator',
            'CategoryValidator',
            'ColumnMoveRestrictionValidator',
            'ColumnRestrictionValidator',
            'ColumnValidator',
            'CommentValidator',
            'CurrencyValidator',
            'CustomFilterValidator',
            'ExternalLinkValidator',
            'GroupValidator',
            'LinkValidator',
            'PasswordResetValidator',
            'ProjectValidator',
            'ProjectRoleValidator',
            'SubtaskValidator',
            'SwimlaneValidator',
            'TagValidator',
            'TaskLinkValidator',
            'TaskValidator',
            'UserValidator',
        ),
        'Import' => array(
            'TaskImport',
            'UserImport',
        ),
        'Export' => array(
            'SubtaskExport',
            'TaskExport',
            'TransitionExport',
        ),
        'Pagination' => array(
            'TaskPagination',
            'SubtaskPagination',
            'ProjectPagination',
            'UserPagination',
        ),
        'Core' => array(
            'DateParser',
            'Lexer',
        ),
        'Core\Event' => array(
            'EventManager',
        ),
        'Core\Http' => array(
            'Request',
            'Response',
            'RememberMeCookie',
        ),
        'Core\Plugin' => array(
            'Hook',
        ),
        'Core\Security' => array(
            'Token',
            'Role',
        ),
        'Core\User' => array(
            'GroupSync',
            'UserSync',
            'UserSession',
            'UserProfile',
        )
    );

    public function register(Container $container)
    {
        Tool::buildDIC($container, $this->classes);

        $container['paginator'] = $container->factory(function ($c) {
            return new Paginator($c);
        });

        $container['oauth'] = $container->factory(function ($c) {
            return new OAuth2($c);
        });

        $container['httpClient'] = function ($c) {
            return new HttpClient($c);
        };

        $container['objectStorage'] = function () {
            return new FileStorage(FILES_DIR);
        };

        $container['cspRules'] = array(
            'default-src' => "'self'",
            'style-src' => "'self' 'unsafe-inline'",
            'img-src' => '* data:',
        );

        return $container;
    }
}