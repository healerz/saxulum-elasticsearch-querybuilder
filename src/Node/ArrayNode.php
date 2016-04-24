<?php

namespace Saxulum\ElasticSearchQueryBuilder\Node;

class ArrayNode extends AbstractParentNode
{
    /**
     * @param AbstractNode $node
     * @return $this
     */
    public function add(AbstractNode $node)
    {
        if (null !== $this->reflectionProperty->getValue($node)) {
            throw new \InvalidArgumentException('Node already got a parent!');
        }

        $this->reflectionProperty->setValue($node, $this);

        $this->children[] = $node;

        return $this;
    }

    /**
     * @return array|null
     */
    public function serialize()
    {
        $serialized = [];
        foreach ($this->children as $child) {
            if (null !== $serializedChild = $child->serialize()) {
                $serialized[] = $serializedChild;
            }
        }

        if (!$this->allowEmpty && [] === $serialized) {
            return null;
        }

        return $serialized;
    }
}
