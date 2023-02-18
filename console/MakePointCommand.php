<?php

namespace Syehan\Gamify\Console;

use October\Rain\Scaffold\GeneratorCommandBase;

class MakePointCommand extends GeneratorCommandBase 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'syehan:gamify-point {namespace : App or Plugin Namespace (eg: Acme.Blog)} 
    {name : The name of the Point. Eg: PointLoggedIn}
    {--o|overwrite : Overwrite existing files with generated ones}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Gamify point type class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $typeLabel = 'Point';

    /**
     * makeStubs makes all stubs
     */
    public function makeStubs()
    {
        $this->makeStub('stubs/point.stub', 'points/{{studly_name}}.php');
    }

    /**
     * prepareVars prepares variables for stubs
     */
    protected function prepareVars(): array
    {
        return [
            'name' => $this->argument('name'),
            'namespace' => $this->argument('namespace'),
        ];
    }
}
