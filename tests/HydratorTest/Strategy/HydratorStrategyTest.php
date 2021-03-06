<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace HydratorTest\Strategy;

use Hydrator\Context\ExtractionContext;
use Hydrator\Context\HydrationContext;
use Hydrator\HydratorInterface;
use Hydrator\Strategy\HydratorStrategy;

class HydratorStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testStrategy()
    {
        $data    = ['foo' => 'bar'];
        $value   = new \stdClass;

        $extractionContext = new ExtractionContext($value);
        $hydrationContext  = new HydrationContext($data, $value);

        $hydrator = $this->getMock(HydratorInterface::class);
        $hydrator->expects($this->once())->method('extract')->with($value, $extractionContext);
        $hydrator->expects($this->once())->method('hydrate')->with($data, $hydrationContext);

        $strategy = new HydratorStrategy($hydrator);
        $strategy->extract($value, $extractionContext);
        $strategy->hydrate($data, $hydrationContext);
    }
}
