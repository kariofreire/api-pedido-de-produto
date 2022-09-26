<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /** @var String DIRETORIO_REPOSITORY */
    const DIRETORIO_REPOSITORY = "./app/Repositories";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {nameRepository?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para criar um Repository.';

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
            $repository_name = $this->argument('nameRepository');

            if (empty($repository_name)) throw new \Exception("Necessário informar o nome do repository.", 1);

            if (count(explode("/", $repository_name)) < 2) throw new \Exception("Necessário que o repository esteja dentro de um sub diretório.", 1);

            [$diretorio, $repository_name] = explode("/", $repository_name);

            if (!is_dir(self::DIRETORIO_REPOSITORY)) mkdir(self::DIRETORIO_REPOSITORY, 0777);

            if (!is_dir(self::DIRETORIO_REPOSITORY . "/{$diretorio}")) mkdir(self::DIRETORIO_REPOSITORY . "/{$diretorio}", 0777);

            $repository_path = self::DIRETORIO_REPOSITORY . "/{$diretorio}/" . trim($repository_name) . ".php";

            if (is_file($repository_path)) throw new \Exception("Repository já existe no projeto.", 1);

            touch($repository_path);

            $repository_file = fopen($repository_path, "r+");

            fwrite($repository_file, self::estrutura_repository($repository_name, $diretorio));

            fclose($repository_file);

            $this->info("Repository created successfully.");
        } catch (\Exception $e) {
            $this->error("ERRO: {$e->getMessage()}");
        }
    }

    /**
     * Retorna estrutura básica de um repository.
     *
     * @param String $repository_name
     * @param String $diretorio
     *
     * @return String
     */
    private static function estrutura_repository(string $repository_name, string $diretorio) : string
    {
        $conteudo = "<?php" . PHP_EOL . PHP_EOL;
        $conteudo .= "namespace App\Repositories\{$diretorio};" . PHP_EOL . PHP_EOL;
        $conteudo .= "use " . str_replace("/", "", "App\Repositories\Contracts\/{$repository_name}Interface") . ";" . PHP_EOL . PHP_EOL;
        $conteudo .= "class {$repository_name} implements {$repository_name}Interface" . PHP_EOL;
        $conteudo .= "{" . PHP_EOL;
        $conteudo .= "\t/**" . PHP_EOL;
        $conteudo .= "\t * Define o Model utilizado neste Repository." . PHP_EOL;
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
