# SEtxt: Описание
Хак SEtxt позволит вам выводить определенный контент который будет виден только на определенных операционных системах и браузере. Так с помощью этого хака, вы сможете вывести в зависимости от браузера юзера или его операционной системы, или же с условием того и другого разный контент.

# SEtxt: Лицензия Rus
Copyright (C) 2016 Gameer
Эта программа является свободным программным обеспечением: вы можете распространять и / или изменять его в соответствии с условиями GNU Affero General Public License, опубликованной Фондом свободного программного обеспечения, либо 3 версии лицензии, либо (по вашему выбору) любой более поздней версии.
Эта программа распространяется в надежде, что она будет полезной, но БЕЗ КАКИХ-ЛИБО ГАРАНТИЙ; даже без подразумеваемых гарантий КОММЕРЧЕСКОЙ ЦЕННОСТИ или ПРИГОДНОСТИ ДЛЯ КОНКРЕТНЫХ ЦЕЛЕЙ. Смотрите GNU Affero General Public License для более подробной информации.
Вы должны были получить копию GNU Affero General Public License вместе с этой программой. Если нет, то смотрите <http://www.gnu.org/licenses/>.

# SEtxt: Лицензия Eng
Copyright (C) 2016 Gameer
This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

# SEtxt: Установка
1. Скопируйте все файлы из папки upload в данном архиве на ваш сервер.
2. Открыть файл <b>/engine/classes/templates.class.php</b> найти:<pre><code>class dle_template {</code></pre>Выше вставить:
<pre><code>require_once ROOT_DIR . '/engine/mod/SEtxt.php';</code></pre>Далее найти:<pre><code>$this->dir = ROOT_DIR . '/templates/';</code></pre>Ниже вставить<pre><code>$this->SEtxt = SEtxt::getSingleton();
$this->SEtxt->construct();</code></pre>Далее найти:<pre><code>$this->_clear();</code></pre>Выше вставить <b>для UTF-8</b>:<pre><code>$this->result[$tpl] = preg_replace_callback("#\\[setxt (.+?)\\](.*?)\\[/setxt\\]#umis", array($this->SEtxt, "checkMatch"), $this->result[$tpl]);</code></pre>Для <b>CP1251</b> вставить:<pre><code>$this->result[$tpl] = preg_replace_callback("#\\[setxt (.+?)\\](.*?)\\[/setxt\\]#mis", array($this->SEtxt, "checkMatch"), $this->result[$tpl]);</code></pre>

# SEtxt: Использование
В нужном tpl доступен тег (несколько значений можно задавать через запятую):<pre><code>[setxt browser="opera,yandex" os="windows"]текст[/setxt]</code></pre>Кроме того можно писать так <pre><code>[setxt browser="opera"]текст[/setxt]</code></pre>Или так<pre><code>[setxt os="linux"]текст[/setxt]</code></pre>В файле <b>Работа с хаком.html</b> найдете перечень значений для параметров.
