<?php

/*
 * This file is part of Hiject.
 *
 * Copyright (C) 2016 Hiject Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/BaseProcedureTest.php';

class BoardProcedureTest extends BaseProcedureTest
{
    protected $projectName = 'My project to test board';

    public function testAll()
    {
        $this->assertCreateTeamProject();
        $this->assertGetBoard();
    }

    public function assertGetBoard()
    {
        $board = $this->app->getBoard($this->projectId);
        $this->assertNotNull($board);
        $this->assertCount(1, $board);
        $this->assertEquals('Default swimlane', $board[0]['name']);

        $this->assertCount(4, $board[0]['columns']);
        $this->assertEquals('Ready', $board[0]['columns'][1]['title']);
    }
}
