<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2018 Carlos Garcia Gomez <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Core\Base;

use FacturaScripts\Core\App\AppSettings;
use FacturaScripts\Core\Base\MiniLog;
use FacturaScripts\Core\Model\LogMessage;

/**
 * Class to read the miniLog
 *
 * @package FacturaScripts\Core\Base
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Cristo M. Estévez Hernández <cristom.estevez@gmail.com>
 */
class MiniLogSave
{

    /**
     * Type of logs 
     *
     * @var array
     */
    const TYPES_LOG = ['info', 'notice', 'warning', 'error',
        'critical', 'alert', 'emergency'
    ];

    /**
     * Read the data from MiniLog and storage in Log table.
     * 
     * @param string $ip
     * @param string $nick
     */
    public function __construct(string $ip = '', string $nick = '')
    {
        $miniLog = new MiniLog();
        foreach ($miniLog->read($this->getActiveSettingsLog()) as $value) {
            $logMessage = new LogMessage();
            $logMessage->time = date('d-m-Y H:i:s', $value["time"]);
            $logMessage->level = $value["level"];
            $logMessage->message = $value["message"];
            $logMessage->ip = empty($ip) ? null : $ip;
            $logMessage->nick = empty($nick) ? null : $nick;
            $logMessage->save();
        }
    }

    /**
     * Get types of settings log enable (true) 
     *
     * @return array
     */
    private function getActiveSettingsLog(): array
    {
        $types = [];
        foreach (self::TYPES_LOG as $value) {
            if (AppSettings::get('log', $value, 'false') == 'true') {
                $types[] = $value;
            }
        }

        return $types;
    }
}
