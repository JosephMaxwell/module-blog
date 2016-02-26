<?php

namespace Mirasvit\Blog\Controller;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Mirasvit\Blog\Model\TagFactory;
use Magento\Framework\Registry;

abstract class Tag extends Action
{
    /**
     * @var TagFactory
     */
    protected $tagFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param TagFactory $tagFactory
     * @param Registry   $registry
     * @param Context    $context
     */
    public function __construct(
        TagFactory $tagFactory,
        Registry $registry,
        Context $context
    ) {
        $this->tagFactory = $tagFactory;
        $this->registry = $registry;
        $this->resultFactory = $context->getResultFactory();;

        parent::__construct($context);
    }

    /**
     * @return \Mirasvit\Blog\Model\Tag
     */
    protected function initModel()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $tag = $this->tagFactory->create()->load($id);
            if ($tag->getId() > 0) {
                $this->registry->register('current_blog_tag', $tag);

                return $tag;
            }
        }
    }
}
