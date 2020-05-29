<?php

namespace ASVoting\Route;



// Each row of this array should return an array of:
// - The path to match
// - The method to match
// - The route info
// - (optional) A setup callable to add middleware/DI info specific to that route
//
// This allows use to configure data per endpoint e.g. the endpoints that should be secured by
// an api key, should call an appropriate callable.
return [
//    ['/', 'GET', 'ASVoting\ApiController\Vote::index'],

    ['/', 'GET', 'ASVoting\ApiController\Motions::getProposedMotions'],

    ['/motions', 'GET', 'ASVoting\ApiController\Motions::getProposedMotions'],
    [
        '/motions_voting',
        'GET',
        'ASVoting\ApiController\Motions::getMotionsBeingVotedOn'
    ],


    // TIFF
//    ['/motions/vote', 'POST', 'ASVoting\ApiController\Vote::postVote'],


//    ['/csp/test', 'GET', 'Osf\CommonController\ContentSecurityPolicy::getTestPage'],
//    ['/csp', 'POST', 'Osf\CommonController\ContentSecurityPolicy::postReport'],
//  ['/projects/{project_name:.+}', 'GET', '\Osf\AppController\Projects::getProject'],

    ['/test/caught_exception', 'GET', 'ASVoting\ApiController\Debug::testCaughtException'],
    ['/test/uncaught_exception', 'GET', 'ASVoting\ApiController\Debug::testUncaughtException'],
    ['/test/xdebug', 'GET', 'ASVoting\ApiController\Debug::testXdebugWorking'],


    ['/{any:.*}', 'GET', 'Osf\ApiController\HealthCheck::get'],
];

