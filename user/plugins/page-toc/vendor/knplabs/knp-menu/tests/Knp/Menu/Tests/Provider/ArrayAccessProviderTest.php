<?php

namespace Knp\Menu\Tests\Provider;

use Knp\Menu\ItemInterface;
use Knp\Menu\Provider\ArrayAccessProvider;
use PHPUnit\Framework\TestCase;

final class ArrayAccessProviderTest extends TestCase
{
    public function testHas(): void
    {
        $provider = new ArrayAccessProvider(new \ArrayObject(), ['first' => 'first', 'second' => 'dummy']);
        $this->assertTrue($provider->has('first'));
        $this->assertTrue($provider->has('second'));
        $this->assertFalse($provider->has('third'));
    }

    public function testGetExistentMenu(): void
    {
        $registry = new \ArrayObject();
        $menu = $this->getMockBuilder(ItemInterface::class)->getMock();
        $registry['menu'] = $menu;
        $provider = new ArrayAccessProvider($registry, ['default' => 'menu']);
        $this->assertSame($menu, $provider->get('default'));
    }

    public function testGetMenuAsClosure(): void
    {
        $registry = new \ArrayObject();
        $menu = $this->getMockBuilder(ItemInterface::class)->getMock();
        $registry['menu'] = static function (array $options, object $c) use ($menu) {
            $c['options'] = $options;

            return $menu;
        };
        $provider = new ArrayAccessProvider($registry, ['default' => 'menu']);

        $this->assertSame($menu, $provider->get('default', ['foo' => 'bar']));
        $this->assertEquals(['foo' => 'bar'], $registry['options']);
    }

    public function testGetNonExistentMenu(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $provider = new ArrayAccessProvider(new \ArrayObject());
        $provider->get('non-existent');
    }
}
