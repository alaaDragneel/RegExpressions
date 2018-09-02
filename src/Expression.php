<?php

namespace RegExpressions;

class Expression
{
    protected $expressions = '';

    /**
     * Make New Instance From The Expression Class
     *
     * @return \RegExpressions\Expression
     */
    public static function make()
    {
        return new static;
    }

    /**
     * Find The Specified String
     *
     * @param string $value
     * @return \RegExpressions\Expression
     */
    public function then($value)
    {
        return $this->find($value);
    }

    /**
     * Find The Specified String
     *
     * @param string $value
     * @return \RegExpressions\Expression
     */
    public function find($value)
    {
        return $this->add($this->sanitize($value));
    }

    /**
     * Find The Any Character
     *
     * @return \RegExpressions\Expression
     */
    public function anything()
    {
        return $this->add(".*");
    }

    /**
     * Find The Any Thing Except Specified String 
     * Negative Look A Head On Value And match 0 Or One Character And Not Be Greedy By Using ( ? ) After
     * 
     * @param string $value
     * @return \RegExpressions\Expression
     */
    public function anythingBut($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?!{$value}).*?");
    }

    /**
     * Look For The Specified String If Found Or Not It's Normal
     *
     * @param string $value
     * @return \RegExpressions\Expression
     */
    public function optional($value)
    {
        return $this->maybe($value);
    }

    /**
     * Look For The Specified String If Found Or Not It's Normal
     *
     * @param string $value
     * @return \RegExpressions\Expression
     */
    public function maybe($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?:{$value})?");
    }

    /**
     * Add New Regular Expression To The [expressions] Property
     *
     * @param string $value
     * @return \RegExpressions\Expression
     */
    protected function add($value)
    {
        $this->expressions .= $value;

        return $this;
    }

    /**
     * Sanitize The Incoming Values From Characters Like [?+.]
     *
     * @param string $value
     * @return string
     */
    protected function sanitize($value)
    {
        return preg_quote($value, '/');
    }

    /**
     * Test The Regular Expression
     *
     * @param string $value
     * @return bool
     */
    public function test($value)
    {   
        return !! preg_match($this->generateExpression(), $value);
    }

    /**
     * Get The Expression
     *
     * @return string
     */
    public function __toString()
    {
        return $this->generateExpression();
    }

    /**
     * Get The Expression
     *
     * @return string
     */
    public function log()
    {
        return $this->generateExpression();
    }

    /**
     * Get The Expression
     *
     * @return string
     */
    public function generateExpression()
    {
        return "/{$this->expressions}/";
    }
}