<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LinhasExtensaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('linhas_extensao')->delete();
        
        \DB::table('linhas_extensao')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Alfabetização, Leitura e Escrita',
                'descricao' => 'Alfabetização e letramento de crianças, jovens e adultos; formação do leitor e do produtor de textos; incentivo à leitura; literatura; desenvolvimento de metodologias de ensino da leitura e da escrita e sua inclusão nos projetos político-pedagógicos das escolas.',
                'created_at' => '2022-04-23 14:05:31',
                'updated_at' => '2022-04-23 14:05:33',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Artes Cênicas',
                'descricao' => 'Dança, teatro, técnicas circenses, performance; formação, capacitação e qualificação de pessoas que atuam na área; memória, produção e difusão cultural e artística.',
                'created_at' => '2022-04-23 14:05:36',
                'updated_at' => '2022-04-23 14:05:37',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Artes Integradas',
                'descricao' => 'Ações multiculturais, envolvendo as diversas áreas da produção e da prática artística em um único programa integrado; memória, produção e difusão cultural e artística.',
                'created_at' => '2022-04-23 14:05:39',
                'updated_at' => '2022-04-23 14:05:40',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Artes Plásticas',
                'descricao' => 'Escultura, pintura, desenho, gravura, instalação, apropriação; formação, memória, produção e difusão cultural e artística.',
                'created_at' => '2022-04-23 14:05:41',
                'updated_at' => '2022-04-23 14:05:41',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Artes Visuais',
                'descricao' => 'Artes gráficas, fotografia, cinema, vídeo; memória, produção e difusão cultural e artística.',
                'created_at' => '2022-04-23 14:05:44',
                'updated_at' => '2022-04-23 14:05:46',
            ),
            5 => 
            array (
                'id' => 6,
                'nome' => 'Comunicação Estratégica',
                'descricao' => 'Elaboração, implementação e avaliação de planos estratégicos de comunicação; realização de assessorias e consultorias para organizações de natureza diversa em atividades de publicidade, propaganda e de relações públicas; suporte de comunicação a programas e projetos de mobilização social, a organizações governamentais e da sociedade civil.',
                'created_at' => '2022-04-23 14:05:47',
                'updated_at' => '2022-04-23 14:05:48',
            ),
            6 => 
            array (
                'id' => 7,
                'nome' => 'Desenvolvimento de Produtos',
                'descricao' => 'Produção de origem animal, vegetal, mineral e laboratorial; manejo, transformação, manipulação, dispensação, conservação e comercialização de produtos e subprodutos.',
                'created_at' => '2022-04-23 14:05:49',
                'updated_at' => '2022-04-23 14:05:50',
            ),
            7 => 
            array (
                'id' => 8,
                'nome' => 'Desenvolvimento Regional',
            'descricao' => 'Elaboração de diagnóstico e de propostas de planejamento regional (urbano e rural) envolvendo práticas destinadas à elaboração de planos diretores, a soluções, tratamento de problemas e melhoria da qualidade de vida da população local, tendo em vista sua capacidade produtiva e potencial de incorporação na implementação das ações; participação em fóruns Desenvolvimento Local Integrado e Sustentável – DLIS; participação e assessoria a conselhos regionais, estaduais e locais de desenvolvimento e a fóruns de municípios e associações afins; elaboração de matrizes e estudos sobre desenvolvimento regional integrado, tendo como base recursos locais renováveis e práticas sustentáveis; permacultura; definição de indicadores e métodos de avaliação de desenvolvimento, crescimento e sustentabilidade.',
                'created_at' => '2022-04-23 14:05:52',
                'updated_at' => '2022-04-23 14:05:53',
            ),
            8 => 
            array (
                'id' => 9,
                'nome' => 'Desenvolvimento Rural e Questão Agrária',
                'descricao' => 'Constituição e/ou implementação de iniciativas de reforma agrária, matrizes produtivas locais ou regionais e de políticas de desenvolvimento rural; assistência técnica; planejamento do desenvolvimento rural sustentável; organização rural; comercialização; agroindústria; gestão de propriedades e/ou organizações; arbitragem de conflitos de reforma agrária; educação para o desenvolvimento rural; definição de critérios e de políticas de fomento para o meio rural; avaliação de impactos de políticas de desenvolvimento rural.',
                'created_at' => '2022-04-23 14:05:54',
                'updated_at' => '2022-04-23 14:05:55',
            ),
            9 => 
            array (
                'id' => 10,
                'nome' => 'Desenvolvimento tecnológico',
            'descricao' => 'Processos de investigação e produção de novas tecnologias, técnicas, processos produtivos, padrões de consumo e produção (inclusive tecnologias sociais, práticas e protocolos de produção de bens e serviços); serviços tecnológicos; estudos de viabilidade técnica, financeira e econômica; adaptação de tecnologias.',
                'created_at' => '2022-04-23 14:05:56',
                'updated_at' => '2022-04-23 14:05:57',
            ),
            10 => 
            array (
                'id' => 11,
                'nome' => 'Desenvolvimento Urbano',
                'descricao' => 'Planejamento, implementação e avaliação de processos e metodologias visando proporcionar soluções e o tratamento de problemas das comunidades urbanas; urbanismo.',
                'created_at' => '2022-04-23 14:05:58',
                'updated_at' => '2022-04-23 14:05:59',
            ),
            11 => 
            array (
                'id' => 12,
                'nome' => 'Direitos Individuais e Coletivos',
                'descricao' => 'Apoio a organizações e ações de memória social, defesa, proteção e promoção de direitos humanos; direito agrário e fundiário; assistência jurídica e judiciária, individual e coletiva, a instituições e organizações; bioética médica e jurídica; ações educativas e preventivas para garantia de direitos humanos.',
                'created_at' => '2022-04-23 14:06:00',
                'updated_at' => '2022-04-23 14:06:01',
            ),
            12 => 
            array (
                'id' => 13,
                'nome' => 'Educação Profissional',
                'descricao' => 'Formação técnica profissional, visando a valorização, aperfeiçoamento, promoção do acesso aos direitos trabalhistas e inserção no mercado de trabalho.',
                'created_at' => '2022-04-23 14:06:02',
                'updated_at' => '2022-04-23 14:06:03',
            ),
            13 => 
            array (
                'id' => 14,
                'nome' => 'Empreendedorismo',
                'descricao' => 'Constituição e gestão de empresas juniores, pré-incubadoras, incubadoras de empresas, parques e pólos tecnológicos, cooperativas e empreendimentos solidários e outras ações voltadas para a identificação, aproveitamento de novas oportunidades e recursos de maneira inovadora, com foco na criação de empregos e negócios, estimulando a pró-atividade.',
                'created_at' => '2022-04-23 14:06:04',
                'updated_at' => '2022-04-23 14:06:04',
            ),
            14 => 
            array (
                'id' => 15,
                'nome' => 'Emprego e Renda / Trabalho e Renda',
                'descricao' => 'Defesa, proteção, promoção e apoio a oportunidades de trabalho, emprego e renda para empreendedores, setor informal, proprietários rurais, formas cooperadas/associadas de produção, empreendimentos produtivos solidários, economia solidária, agricultura familiar, dentre outros.',
                'created_at' => '2022-04-23 14:06:06',
                'updated_at' => '2022-04-23 14:06:06',
            ),
            15 => 
            array (
                'id' => 16,
                'nome' => 'Endemias e Epidemias',
                'descricao' => 'Planejamento, implementação e avaliação de metodologias de intervenção e de investigação tendo como tema o perfil epidemiológico de endemias e epidemias e a transmissão de doenças no meio rural e urbano; previsão e prevenção.',
                'created_at' => '2022-04-23 14:06:07',
                'updated_at' => '2022-04-23 14:06:08',
            ),
            16 => 
            array (
                'id' => 17,
                'nome' => 'Espaços de Ciência',
                'descricao' => 'Difusão e divulgação de conhecimentos científicos e tecnológicos em espaços de ciência, como museus, observatórios, planetários, estações marinhas, entre outros; organização desses espaços.',
                'created_at' => '2022-04-23 14:06:10',
                'updated_at' => '2022-04-23 14:06:11',
            ),
            17 => 
            array (
                'id' => 18,
                'nome' => 'Esporte e Lazer',
                'descricao' => 'Práticas esportivas, experiências culturais, atividades físicas e vivências de lazer para crianças, jovens e adultos, como princípios de cidadania, inclusão, participação social e promoção da saúde; esportes e lazer nos projetos político-pedagógico das escolas; desenvolvimento de metodologias e inovações pedagógicas no ensino da Educação Física, Esportes e Lazer; iniciação e prática esportiva; detecção e fomento de talentos esportivos.',
                'created_at' => '2022-04-23 14:06:11',
                'updated_at' => '2022-04-23 14:06:12',
            ),
            18 => 
            array (
                'id' => 19,
                'nome' => 'Estilismo',
                'descricao' => 'Estilismo e moda',
                'created_at' => '2022-04-23 14:06:13',
                'updated_at' => '2022-04-23 14:06:14',
            ),
            19 => 
            array (
                'id' => 20,
                'nome' => 'Fármacos e Medicamentos',
                'descricao' => 'Uso correto de medicamentos para a assistência à saúde, em seus processos que envolvem a farmacoterapia; farmácia nuclear; diagnóstico laboratorial; análises químicas, físico-químicas, biológicas, microbiológicas e toxicológicas de fármacos, insumos farmacêuticos, medicamentos e fitoterápicos.',
                'created_at' => '2022-04-23 14:06:15',
                'updated_at' => '2022-04-23 14:06:16',
            ),
            20 => 
            array (
                'id' => 21,
            'nome' => 'Formação de Professores (Formação Docente)',
                'descricao' => 'Formação e valorização de professores, envolvendo a discussão de fundamentos e estratégias para a organização do trabalho pedagógico, tendo em vista o aprimoramento profissional, a valorização, a garantia de direitos trabalhistas e a inclusão no mercado de trabalho formal.',
                'created_at' => '2022-04-23 14:06:20',
                'updated_at' => '2022-04-23 14:06:21',
            ),
            21 => 
            array (
                'id' => 22,
                'nome' => 'Gestão do Trabalho',
            'descricao' => 'Estratégias de administração; ambiente empresarial; relações de trabalho urbano e rural (formas associadas de produção, trabalho informal, incubadora de cooperativas populares, agronegócios, agroindústria, práticas e produções caseiras, dentre outros).',
                'created_at' => '2022-04-23 14:06:22',
                'updated_at' => '2022-04-23 14:06:23',
            ),
            22 => 
            array (
                'id' => 23,
                'nome' => 'Gestão Informacional',
                'descricao' => 'Sistemas de fornecimento e divulgação de informações econômicas, financeiras, físicas e sociais das instituições públicas, privadas e do terceiro setor.',
                'created_at' => '2022-04-23 14:06:24',
                'updated_at' => '2022-04-23 14:06:25',
            ),
            23 => 
            array (
                'id' => 24,
                'nome' => 'Gestão Institucional',
                'descricao' => 'Estratégias administrativas e organizacionais em órgãos e instituições públicas, privadas e do terceiro setor, governamentais e não governamentais.',
                'created_at' => '2022-04-23 14:06:26',
                'updated_at' => '2022-04-23 14:06:26',
            ),
            24 => 
            array (
                'id' => 25,
                'nome' => 'Gestão Pública',
            'descricao' => 'Sistemas regionais e locais de políticas públicas; análise do impacto dos fatores sociais, econômicos e demográficos nas políticas públicas (movimentos populacionais, geográficos e econômicos, setores produtivos); formação, capacitação e qualificação de pessoas que atuam nos sistemas públicos (atuais ou potenciais).',
                'created_at' => '2022-04-23 14:06:27',
                'updated_at' => '2022-04-23 14:06:28',
            ),
            25 => 
            array (
                'id' => 26,
                'nome' => 'Grupos Sociais Vulneráveis',
            'descricao' => 'Questões de gênero, de etnia, de orientação sexual, de diversidade cultural, de credos religiosos, dentre outros, processos de atenção (educação, saúde, assistência social, etc), de emancipação, de respeito à identidade e inclusão; promoção, defesa e garantia de direitos; desenvolvimento de metodologias de intervenção.',
                'created_at' => '2022-04-23 14:06:29',
                'updated_at' => '2022-04-23 14:06:30',
            ),
            26 => 
            array (
                'id' => 27,
                'nome' => 'Infância e Adolescência',
            'descricao' => 'Processos de atenção (educação, saúde, assistência social, etc.), promoção, defesa e garantia de direitos; ações especiais de prevenção e erradicação do trabalho infantil; desenvolvimento de metodologias de intervenção tendo como objeto enfocado na ação crianças, adolescentes e suas famílias.',
                'created_at' => '2022-04-23 14:06:31',
                'updated_at' => '2022-04-23 14:06:32',
            ),
            27 => 
            array (
                'id' => 28,
                'nome' => 'Inovação Tecnológica',
            'descricao' => 'Introdução de produtos ou processos tecnologicamente novos e melhorias significativas a serem implementadas em produtos ou processos existentes nas diversas áreas do conhecimento; considera-se uma inovação tecnológica de produto ou processo aquela que tenha sido implementada e introduzida no mercado (inovação de produto) ou utilizada no processo de produção (inovação de processo).',
                'created_at' => '2022-04-23 14:06:33',
                'updated_at' => '2022-04-23 14:06:33',
            ),
            28 => 
            array (
                'id' => 29,
                'nome' => 'Jornalismo',
                'descricao' => 'Processos de produção e edição de notícias para mídias impressas e eletrônicas; assessorias e consultorias para órgãos de imprensa em geral; crítica de mídia.',
                'created_at' => '2022-04-23 14:06:34',
                'updated_at' => '2022-04-23 14:06:35',
            ),
            29 => 
            array (
                'id' => 30,
                'nome' => 'Jovens e Adultos',
            'descricao' => 'Processos de atenção (saúde, assistência social, etc.), emancipação e inclusão; educação formal e não formal; promoção, defesa e garantia de direitos; desenvolvimento de metodologias de intervenção, tendo como objeto a juventude e/ou a idade adulta.',
                'created_at' => '2022-04-23 14:06:36',
                'updated_at' => '2022-04-23 14:06:38',
            ),
            30 => 
            array (
                'id' => 31,
                'nome' => 'Línguas Estrangeiras',
                'descricao' => 'Processos de ensino/aprendizagem de línguas estrangeiras e sua inclusão nos projetos político-pedagógicos das escolas; desenvolvimento de processos de formação em línguas estrangeiras; literatura; tradução.',
                'created_at' => '2022-04-23 14:06:39',
                'updated_at' => '2022-04-23 14:06:40',
            ),
            31 => 
            array (
                'id' => 32,
                'nome' => 'Metodologias e Estratégias de Ensino/Aprendizagem',
                'descricao' => 'Metodologias e estratégias específicas de ensino/aprendizagem, como a educação a distância, o ensino presencial e de pedagogia de formação inicial, educação continuada, educação permanente e formação profissional.',
                'created_at' => '2022-04-23 14:06:41',
                'updated_at' => '2022-04-23 14:06:42',
            ),
            32 => 
            array (
                'id' => 33,
                'nome' => 'Mídias-Artes',
                'descricao' => 'Mídias contemporâneas, multimídia, web-arte, arte digital.',
                'created_at' => '2022-04-23 14:06:43',
                'updated_at' => '2022-04-23 14:06:44',
            ),
            33 => 
            array (
                'id' => 34,
                'nome' => 'Mídias',
            'descricao' => 'Veículos comunitários e universitários, impressos e eletrônicos (boletins, rádio, televisão, jornal, revistas, internet, etc.); promoção do uso didático dos meios de educação e de ações educativas sobre as mídias.',
                'created_at' => '2022-04-23 14:07:28',
                'updated_at' => '2022-04-23 14:07:30',
            ),
            34 => 
            array (
                'id' => 35,
                'nome' => 'Música',
                'descricao' => 'Apreciação, criação e performance; formação, capacitação e qualificação de pessoas que atuam na área musical; produção e divulgação de informações, conhecimentos e material didático na área; memória, produção e difusão cultural e artística.',
                'created_at' => '2022-04-23 14:07:31',
                'updated_at' => '2022-04-23 14:07:32',
            ),
            35 => 
            array (
                'id' => 36,
                'nome' => 'Organizações da Sociedade Civil e Movimentos Sociais e Populares',
                'descricao' => 'Apoio à formação, organização e desenvolvimento de comitês, comissões, fóruns, associações, ONG’s, OSCIP’s, redes, cooperativas populares, sindicatos, dentre outros.',
                'created_at' => '2022-04-23 14:07:41',
                'updated_at' => '2022-04-23 14:07:42',
            ),
            36 => 
            array (
                'id' => 37,
                'nome' => 'Patrimônio Cultural, Histórico, Natural e Imaterial.',
            'descricao' => 'Preservação, recuperação, promoção e difusão de patrimônio artístico, cultural e histórico (bens culturais móveis e imóveis, obras de arte, arquitetura, espaço urbano, paisagismo, música, literatura, teatro, dança, artesanato, folclore, manifestações religiosas populares), natural (natureza, meio ambiente) material e imaterial (culinária, costumes do povo), mediante formação, organização, manutenção, ampliação e equipamento de museus, bibliotecas, centros culturais, arquivos e outras organizações culturais, coleções e acervos; restauração de bens móveis e imóveis de reconhecido valor cultural; proteção e promoção do folclore, do artesanato, das tradições culturais e dos movimentos religiosos populares; valorização do patrimônio; memória, produção e difusão cultural e artística.',
                'created_at' => '2022-04-23 14:07:43',
                'updated_at' => '2022-04-23 14:07:44',
            ),
            37 => 
            array (
                'id' => 38,
                'nome' => 'Pessoas com Deficiências, Incapacidades, e Necessidades Especiais.',
            'descricao' => 'Processos de atenção (educação, saúde, assistência social, etc.), de emancipação e inclusão de pessoas com deficiências, incapacidades físicas, sensoriais e mentais, síndromes, doenças crônicas, altas habilidades, dentre outras; promoção, defesa e garantia de direitos; desenvolvimento de metodologias de intervenção individual e coletiva, tendo como objeto enfocado na ação essas pessoas e suas famílias.',
                'created_at' => '2022-04-23 14:07:45',
                'updated_at' => '2022-04-23 14:07:47',
            ),
            38 => 
            array (
                'id' => 39,
                'nome' => 'Propriedade Intelectual e Patente',
                'descricao' => 'Processos de identificação, regulamentação e registro de direitos autorais e sobre propriedade intelectual e patente.',
                'created_at' => '2022-04-23 14:07:49',
                'updated_at' => '2022-04-23 14:07:50',
            ),
            39 => 
            array (
                'id' => 40,
                'nome' => 'Questões Ambientais',
                'descricao' => 'Implementação e avaliação de processos de educação ambiental de redução da poluição do ar, águas e solo; discussão da Agenda 21; discussão de impactos ambientais de empreendimentos e de planos básicos ambientais; preservação de recursos naturais e planejamento ambiental; questões florestais; meio ambiente e qualidade de vida; cidadania e meio ambiente.',
                'created_at' => '2022-04-23 14:07:50',
                'updated_at' => '2022-04-23 14:07:51',
            ),
            40 => 
            array (
                'id' => 41,
                'nome' => 'Recursos Hídricos',
                'descricao' => 'Planejamento de microbacias, preservação de mata ciliar e dos recursos hídricos, gerenciamento de recursos hídricos e bacias hidrográficas; prevenção e controle da poluição; arbitragem de conflitos; participação em agências e comitês estaduais e nacionais; assessoria técnica a conselhos estaduais, comitês e consórcios municipais de recursos hídricos.',
                'created_at' => '2022-04-23 14:07:52',
                'updated_at' => '2022-04-23 14:07:53',
            ),
            41 => 
            array (
                'id' => 42,
                'nome' => 'Resíduos Sólidos',
            'descricao' => 'Orientação para desenvolvimento de ações normativas, operacionais, financeiras e de planejamento com base em critérios sanitários, ambientais e econômicos, para coletar, segregar, tratar e dispor o lixo; orientação para elaboração e desenvolvimento de projetos de planos de gestão integrada de resíduos sólidos urbanos, coleta seletiva, instalação de manejo de resíduos sólidos urbanos reaproveitáveis (compostagem e reciclagem), destinação final (aterros sanitários e controlados), e remediação de resíduos a céu aberto; orientação à organização de catadores de lixo.',
                'created_at' => '2022-04-23 14:07:54',
                'updated_at' => '2022-04-23 14:07:55',
            ),
            42 => 
            array (
                'id' => 43,
                'nome' => 'Saúde Animal',
                'descricao' => 'Processos e metodologias visando a assistência à saúde animal: prevenção, diagnóstico e tratamento; prestação de serviços institucionais em laboratórios, clínicas e hospitais veterinários universitários',
                'created_at' => '2022-04-23 14:07:56',
                'updated_at' => '2022-04-23 14:07:57',
            ),
            43 => 
            array (
                'id' => 44,
                'nome' => 'Saúde da Família',
                'descricao' => 'Processos assistenciais e metodologias de intervenção para a saúde da família',
                'created_at' => '2022-04-23 14:07:58',
                'updated_at' => '2022-04-23 14:07:59',
            ),
            44 => 
            array (
                'id' => 45,
                'nome' => 'Saúde e Proteção no Trabalho',
                'descricao' => 'Processos assistenciais, metodologias de intervenção, ergonomia, educação para a saúde e vigilância epidemiológica ambiental, tendo como alvo o ambiente de trabalho e como público os trabalhadores urbanos e rurais; saúde ocupacional.',
                'created_at' => '2022-04-23 14:08:01',
                'updated_at' => '2022-04-23 14:08:02',
            ),
            45 => 
            array (
                'id' => 46,
                'nome' => 'Saúde Humana',
                'descricao' => 'Promoção da saúde das pessoas, famílias e comunidades; humanização dos serviços; prestação de serviços institucionais em ambulatórios, laboratórios, clínicas e hospitais universitários; assistência à saúde de pessoas em serviços especializados de diagnóstico, análises clínicas e tratamento; clínicas odontológicas, de psicologia, dentre outras.',
                'created_at' => '2022-04-23 14:08:03',
                'updated_at' => '2022-04-23 14:08:04',
            ),
            46 => 
            array (
                'id' => 47,
                'nome' => 'Segurança Alimentar e Nutricional',
                'descricao' => 'Incentivo à produção de alimentos básicos, auto-abastecimento, agricultura urbana, hortas escolares e comunitárias, nutrição, educação para o consumo, regulação do mercado de alimentos, promoção e defesa do consumo alimentar',
                'created_at' => '2022-04-23 14:08:05',
                'updated_at' => '2022-04-23 14:08:06',
            ),
            47 => 
            array (
                'id' => 48,
                'nome' => 'Segurança Pública e Defesa Social',
                'descricao' => 'Planejamento, implementação e avaliação de processos e metodologias, dentro de uma compreensão global do conceito de segurança pública, visando proporcionar soluções e tratamento de problemas relacionados; orientação e assistência jurídica, judiciária, psicológica e social à população carcerária e seus familiares; assessoria a projetos de educação, saúde e trabalho aos apenados e familiares; questão penitenciária; violência; mediação de conflitos; atenção a vítimas de crimes violentos; proteção a testemunhas; policiamento comunitário.',
                'created_at' => '2022-04-23 14:08:07',
                'updated_at' => '2022-04-23 14:08:08',
            ),
            48 => 
            array (
                'id' => 49,
                'nome' => 'Tecnologia da Informação',
                'descricao' => 'Desenvolvimento de competência informacional para identificar, localizar, interpretar, relacionar, analisar, sintetizar, avaliar e comunicar informação em fontes impressas ou eletrônicas; inclusão digital.',
                'created_at' => '2022-04-23 14:08:09',
                'updated_at' => '2022-04-23 14:08:10',
            ),
            49 => 
            array (
                'id' => 50,
                'nome' => 'Temas Específicos/Desenvolvimento Humano.',
            'descricao' => 'Temas das diversas áreas do conhecimento, especialmente de ciências humanas, biológicas, sociais aplicadas, exatas e da terra, da saúde, ciências agrárias, engenharias, lingüística, (letras e artes), visando a reflexão, discussão, atualização e aperfeiçoamento humano',
                'created_at' => '2022-04-23 14:08:11',
                'updated_at' => '2022-04-23 14:08:12',
            ),
            50 => 
            array (
                'id' => 51,
                'nome' => 'Terceira Idade',
            'descricao' => 'Planejamento, implementação e avaliação de processos de atenção (educação, saúde, assistência social, etc), de emancipação e inclusão; promoção, defesa e garantia de direitos; desenvolvimento de metodologias de intervenção, tendo como objeto enfocado na ação pessoas idosas e suas famílias.',
                'created_at' => '2022-04-23 14:08:14',
                'updated_at' => '2022-04-23 14:08:15',
            ),
            51 => 
            array (
                'id' => 52,
                'nome' => 'Turismo',
            'descricao' => 'Planejamento e implementação do turismo (ecológico, cultural, de lazer, de negócios, religioso, etc) como setor gerador de emprego e renda; desenvolvimento de novas tecnologias para avaliações de potencial turístico; produção e divulgação de imagens em acordo com as especificidades culturais das populações locais.',
                'created_at' => '2022-04-23 14:08:16',
                'updated_at' => '2022-04-23 14:08:17',
            ),
            52 => 
            array (
                'id' => 53,
                'nome' => 'Uso de Drogas e Dependência Química',
                'descricao' => 'Prevenção e limitação da incidência e do consumo de drogas; tratamento de dependentes; assistência e orientação a usuários de drogas; recuperação e reintegração social.',
                'created_at' => '2022-04-23 14:08:18',
                'updated_at' => '2022-04-23 14:08:19',
            ),
        ));
        
        
    }
}