CREATE TABLE public.cliente (
    codigo integer NOT NULL,
    nome character varying(25) NOT NULL,
    telefone character varying(25)
);

ALTER TABLE public.cliente OWNER TO postgres;

CREATE SEQUENCE public.cliente_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.cliente_codigo_seq OWNER TO postgres;

ALTER SEQUENCE public.cliente_codigo_seq OWNED BY public.cliente.codigo;

ALTER TABLE ONLY public.cliente ALTER COLUMN codigo SET DEFAULT nextval('public.cliente_codigo_seq'::regclass);

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (codigo);



CREATE TABLE public.veiculo (
    codigo integer NOT NULL,
    modelo character varying(40) NOT NULL,
    placa character varying(9) NOT NULL
);

ALTER TABLE public.veiculo OWNER TO postgres;

CREATE SEQUENCE public.veiculo_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.veiculo_codigo_seq OWNER TO postgres;

ALTER SEQUENCE public.veiculo_codigo_seq OWNED BY public.veiculo.codigo;

ALTER TABLE ONLY public.veiculo ALTER COLUMN codigo SET DEFAULT nextval('public.veiculo_codigo_seq'::regclass);

ALTER TABLE ONLY public.veiculo
    ADD CONSTRAINT veiculo_pkey PRIMARY KEY (codigo);



CREATE TABLE public.aluguel (
    codigo integer NOT NULL,
    dataInicio character varying(40) NOT NULL,
    dataFim character varying(40) NOT NULL,
    preco money,
    situacao character varying(1),
    cliente integer NOT NULL,
    veiculo integer NOT NULL
	);

ALTER TABLE public.aluguel OWNER TO postgres;

CREATE SEQUENCE public.aluguel_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.aluguel_codigo_seq OWNER TO postgres;

ALTER SEQUENCE public.aluguel_codigo_seq OWNED BY public.aluguel.codigo;

ALTER TABLE ONLY public.aluguel ALTER COLUMN codigo SET DEFAULT nextval('public.aluguel_codigo_seq'::regclass);

ALTER TABLE ONLY public.aluguel
    ADD CONSTRAINT aluguel_pkey PRIMARY KEY (codigo);

ALTER TABLE ONLY public.aluguel
    ADD CONSTRAINT "clienteA" FOREIGN KEY (cliente) REFERENCES public.cliente(codigo);

ALTER TABLE ONLY public.aluguel
    ADD CONSTRAINT "veiculoA" FOREIGN KEY (veiculo) REFERENCES public.veiculo(codigo);