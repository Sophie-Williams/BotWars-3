<?php
/**
 * This file is part of BotWars.
 * Please check the file LICENSE.md for information about the license.
 *
 * @copyright Daniel Haas 2014
 * @author Daniel Haas <daniel@file-factory.de>
 */

namespace BotWars;
use BotWars\Arena\PlayField;
use BotWars\Bot\BotBase;


/**
 * Wraps a specific bot and makes sure the bot has all the api available that is needed.
 */
class BotProxy
{
	/** @var  PlayField */
	private $playField;
	/** @var BotBase */
	private $botImplementation;

	function __construct($_filePath,$_team,$_energyAvailable)
	{
		$botClassName=require_once($_filePath);
		$this->botImplementation=new $botClassName($_team,$_energyAvailable);
		if (!$this->botImplementation instanceof BotBase)
		{
			throw new \RuntimeException("Invalid bot class returned from bot-file!");
		}

	}

	/**
	 * @return \BotWars\Arena\PlayField
	 */
	public function getPlayField()
	{
		return $this->playField;
	}

	/**
	 * @param \BotWars\Arena\PlayField $playField
	 */
	public function setPlayField(PlayField $playField)
	{
		$this->playField = $playField;
		$this->botImplementation->setPlayField($playField);
	}

	public function nextTurn()
	{
		$this->botImplementation->nextTurn();
	}
} 