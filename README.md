![version](https://img.shields.io/badge/version-2.0-red.svg?style=flat-square "Version")
![DLE](https://img.shields.io/badge/DLE-9.X--11.x-green.svg?style=flat-square "DLE Version")
[![MIT License](https://img.shields.io/badge/license-AGPL_3.0-blue.svg?style=flat-square)](https://github.com/Gameerr/SEtxt/blob/master/LICENSE)

# SEtxt: Описание
Хак SEtxt позволит вам выводить определенный контент который будет виден только на определенных операционных системах и браузере. Так с помощью этого хака, вы сможете вывести в зависимости от браузера юзера или его операционной системы, или же с условием того и другого разный контент.

# SEtxt: Лицензия Rus
Copyright (C) 2016 Gameer<br />
Эта программа является свободным программным обеспечением: вы можете распространять и / или изменять его в соответствии с условиями GNU Affero General Public License, опубликованной Фондом свободного программного обеспечения, либо 3 версии лицензии, либо (по вашему выбору) любой более поздней версии.<br />
Эта программа распространяется в надежде, что она будет полезной, но БЕЗ КАКИХ-ЛИБО ГАРАНТИЙ; даже без подразумеваемых гарантий КОММЕРЧЕСКОЙ ЦЕННОСТИ или ПРИГОДНОСТИ ДЛЯ КОНКРЕТНЫХ ЦЕЛЕЙ. Смотрите GNU Affero General Public License для более подробной информации.<br />
Вы должны были получить копию GNU Affero General Public License вместе с этой программой. Если нет, то смотрите <http://www.gnu.org/licenses/>.

# SEtxt: Лицензия Eng
Copyright (C) 2016 Gameer<br />
This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.<br />
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.<br />
You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

# SEtxt: Установка
1. Скопируйте все файлы из папки upload в данном архиве на ваш сервер.
2. Открыть файл <b>/engine/classes/templates.class.php</b> найти:<pre><code>class dle_template {</code></pre>Выше вставить:
<pre><code>require_once ROOT_DIR . '/engine/mod/SEtxt.php';</code></pre>Далее найти:<pre><code>$this->dir = ROOT_DIR . '/templates/';</code></pre>Ниже вставить<pre><code>$this->SEtxt = SEtxt::getSingleton();
$this->SEtxt->construct();</code></pre>Далее найти:<pre><code>$this->_clear();</code></pre>Выше вставить <b>для UTF-8</b>:<br />`$this->result[$tpl] = preg_replace_callback("#\\[setxt (.+?)\\](.*?)\\[/setxt\\]#umis", array($this->SEtxt, "checkMatch"), $this->result[$tpl]);`<br />Для <b>CP1251</b> вставить:<br />`$this->result[$tpl] = preg_replace_callback("#\\[setxt (.+?)\\](.*?)\\[/setxt\\]#mis", array($this->SEtxt, "checkMatch"), $this->result[$tpl]);`

# SEtxt: Использование
В нужном tpl доступен тег (несколько значений можно задавать через запятую):<br />`[setxt browser="opera,yandex" os="windows"]текст[/setxt]`<br />Кроме того можно писать так<br />`[setxt browser="opera"]текст[/setxt]`<br />Или так<br />`[setxt os="linux"]текст[/setxt]`<br />Или так:<br />`[setxt browser-not="opera,yandex" os="windows"]текст[/setxt]`<br />Кроме того можно писать так<br />`[setxt browser-not="opera"]текст[/setxt]`<br />Или так<br />`[setxt os-not="linux"]текст[/setxt]`<br />Или так<br />`[setxt browser-not="opera,yandex" os-not="windows"]текст[/setxt]`<br />Приставки <b>-not</b> работают в обрабтном значении, то есть для всех кроме этих значений покажется текст.<br />В файле <b>Работа с хаком.html</b> найдете перечень значений для параметров.
