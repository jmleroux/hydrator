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

namespace HydratorTest;

use Hydrator\ClassMethodsHydrator;
use HydratorTest\Asset\ClassMethods;

class ClassMethodsHydratorTest extends \PHPUnit_Framework_TestCase
{
    public function testExtraction()
    {
        $object = new ClassMethods();
        $object->setFirstName('Abdul Malik');
        $object->setLastName('Ikhsan');
        $object->setHasDog(false);
        $object->setIsDead(false);

        $hydrator = new ClassMethodsHydrator();

        $expectedData = [
            'first_name' => 'Abdul Malik',
            'last_name'  => 'Ikhsan',
            'is_dead'    => false,
            'has_dog'    => false
        ];

        $data = $hydrator->extract($object);

        $this->assertEquals($expectedData, $data);
    }

    public function testHydration()
    {
        $object   = new ClassMethods();
        $hydrator = new ClassMethodsHydrator();

        $result = $hydrator->hydrate([
            'first_name' => 'Ben',
            'last_name'  => 'Scholzen',
            'has_dog'    => true,
            'is_dead'    => false
        ], $object);

        $this->assertSame($object, $result);
        $this->assertEquals('Ben', $object->getFirstName());
        $this->assertEquals('Scholzen', $object->getLastName());
        $this->assertTrue($object->hasDog());
        $this->assertFalse($object->isDead());
    }
}
