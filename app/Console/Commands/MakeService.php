<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /** @var String DIRETORIO_SERVICE */
    const DIRETORIO_SERVICE = "./app/Services";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {nameService?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um arquivo service no projeto.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $service_name = $this->argument('nameService');

            if (empty($service_name)) throw new \Exception("Necessário informar o nome do service.", 1);

            if (count(explode("/", $service_name)) < 2) throw new \Exception("Necessário que o service esteja dentro de um sub diretório.", 1);

            [$diretorio, $service_name] = explode("/", $service_name);

            if (!is_dir(self::DIRETORIO_SERVICE)) mkdir(self::DIRETORIO_SERVICE, 0777);

            if (!is_dir(self::DIRETORIO_SERVICE . "/{$diretorio}")) mkdir(self::DIRETORIO_SERVICE . "/{$diretorio}", 0777);

            $service_path = self::DIRETORIO_SERVICE . "/{$diretorio}/" . trim($service_name) . ".php";

            if (is_file($service_path)) throw new \Exception("Service já existe no projeto.", 1);

            touch($service_path);

            $service_file = fopen($service_path, "r+");

            fwrite($service_file, self::estrutura_service($service_name, $diretorio));

            fclose($service_file);

            $this->info("Service created successfully.");
        } catch (\Exception $e) {
            $this->error("ERRO: {$e->getMessage()}");
        }
    }

    /**
     * Retorna estrutura básica de um service.
     *
     * @param String $service_name
     * @param String $subdiretorio
     *
     * @return String
     */
    private static function estrutura_service(string $service_name, string $subdiretorio) : string
    {
        $conteudo = "<?php" . PHP_EOL . PHP_EOL;
        $conteudo .= "namespace " . str_replace(" ", "", "App \ Services \ $subdiretorio ;") . PHP_EOL . PHP_EOL;
        $conteudo .= "class {$service_name}" . PHP_EOL;
        $conteudo .= "{" . PHP_EOL;
        $conteudo .= "\t/**" . PHP_EOL;
        $conteudo .= "\t * Define a Interface utilizada neste Service." . PHP_EOL;
        $conteudo .= "\t *" . PHP_EOL;
        $conteudo .= "\t * @return Void" . PHP_EOL;
        $conteudo .= "\t */" . PHP_EOL;
        $conteudo .= "\tpublic function __construct()" . PHP_EOL;
        $conteudo .= "\t{" . PHP_EOL;
        $conteudo .= "\t\t//" . PHP_EOL;
        $conteudo .= "\t}" . PHP_EOL;
        $conteudo .= "}" . PHP_EOL;

        return $conteudo;
    }
}
