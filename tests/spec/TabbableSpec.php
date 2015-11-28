<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TabbableSpec extends ObjectBehavior
{

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function let($navigation)
    {
        $navigation->autoroute(false)->willReturn($navigation);
        $navigation->withAttributes(['role' => 'tablist'])->willReturn(
            $navigation
        );
        $navigation->render()->willReturn('<nav>foo</nav>');
        $this->beConstructedWith($navigation);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Tabbable');
        $this->shouldHaveType('Bootstrapper\RenderedObject');
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_can_be_rendered($navigation)
    {
        $navigation->links([])->willReturn($navigation);
        $this->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_can_be_made_into_tabs($navigation)
    {
        $navigation->tabs()->willReturn($navigation);
        $navigation->links([])->willReturn($navigation);
        $this->tabs()->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_can_be_made_into_pills($navigation)
    {
        $navigation->pills()->willReturn($navigation);
        $navigation->links([])->willReturn($navigation);
        $this->pills()->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_can_be_given_contents($navigation)
    {
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);
        $this->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_allows_you_to_specify_which_should_be_active($navigation)
    {
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);

        $this->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->active(1)->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane' id='first'>foo</div><div class='tab-pane active' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    function it_handles_being_pills_correctly($navigation)
    {
        $navigation->pills()->willReturn($navigation);
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "pill"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "pill"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "pill"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);
        $navigation->render()->willReturn("<nav>foo</nav>");

        $this->pills()->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_allows_you_to_use_a_shortcut_for_pills($navigation)
    {
        $navigation->pills()->willReturn($navigation);
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "pill"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "pill"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "pill"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);
        $navigation->render()->willReturn("<nav>foo</nav>");

        $this->pills(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_allows_you_to_use_a_shortcut_for_tabs($navigation)
    {
        $navigation->tabs()->willReturn($navigation);
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);
        $navigation->render()->willReturn("<nav>foo</nav>");
        $this->tabs(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );

    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_allows_you_to_fade_things($navigation)
    {
        $navigation->tabs()->willReturn($navigation);
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);
        $navigation->render()->willReturn("<nav>foo</nav>");

        $this->tabs(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->fade()->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane fade in active' id='first'>foo</div><div class='tab-pane fade' id='second'>foo</div><div class='tab-pane fade' id='third'>foo</div></div>"
        );
    }

    /**
     * @param \Bootstrapper\Navigation $navigation
     */
    function it_allows_you_to_add_attributes_to_the_tabs($navigation)
    {
        $navigation->links(
            [
                [
                    "link" => "#first",
                    "title" => "First",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => true
                ],
                [
                    "link" => "#second",
                    "title" => "Second",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ],
                [
                    "link" => "#third",
                    "title" => "Third",
                    "linkAttributes" => [
                        "role" => "tab",
                        "data-toggle" => "tab"
                    ],
                    "active" => false
                ]
            ]
        )->willReturn($navigation);

        $this->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo',
                    'attributes' => ['data-foo' => 'bar']
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo',
                    'attributes' => ['id' => 'foo']
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<nav>foo</nav><div class='tab-content'><div class='tab-pane active' id='first' data-foo='bar'>foo</div><div class='tab-pane' id='foo'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }
}
