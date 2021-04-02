<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/7 8:37 下午
 * description : 响应markdown
 */

class Gring_Hi_Messages_Md extends Gring_Hi_Messages_Message {

    private $templates = array();

    /**
     * @param  array  $templates
     * @return $this
     */
    public function setTemplates(array $templates) {
        foreach ($templates as $template) {
            if ($template instanceof Gring_Hi_Contracts_TemplateInterface) {
                $this->setTemplate($template);
            } else {
                throw new InvalidArgumentException(
                    sprintf(
                        'Class "%s" not an instance of "%s".',
                        $template,
                        Gring_Hi_Contracts_TemplateInterface::class
                    )
                );
            }
        }
        return $this;
    }

    /**
     * @param  Gring_Hi_Contracts_TemplateInterface  $template
     * @return $this
     */
    public function setTemplate(Gring_Hi_Contracts_TemplateInterface $template) {
        $this->templates[] = $template;
        return $this;
    }

    /**
     * @return $this
     */
    public function convert(){
        $toMarkdown = new Gring_Hi_Parser_ConverterExtra();
        /* @var Gring_Hi_Contracts_TemplateInterface $template */
        foreach ($this->templates as $template){
            $this->attributes['content'] .= $toMarkdown->parseString($template->render());
            $this->attributes['content'] .= "\n";
        }
        return $this;
    }
}