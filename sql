--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

-- Started on 2018-02-20 08:38:47 +09

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12397)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 182 (class 1259 OID 16420)
-- Name: object; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE object (
    id bigint NOT NULL,
    name text,
    "position" bigint DEFAULT 0 NOT NULL
);


ALTER TABLE object OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 16418)
-- Name: object_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE object_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE object_id_seq OWNER TO postgres;

--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 181
-- Name: object_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE object_id_seq OWNED BY object.id;


--
-- TOC entry 183 (class 1259 OID 16429)
-- Name: subdivision; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE subdivision (
    id bigint NOT NULL,
    name text,
    object_id bigint,
    "position" bigint DEFAULT 0 NOT NULL
);


ALTER TABLE subdivision OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 16432)
-- Name: subdivision_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE subdivision_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subdivision_id_seq OWNER TO postgres;

--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 184
-- Name: subdivision_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE subdivision_id_seq OWNED BY subdivision.id;


--
-- TOC entry 186 (class 1259 OID 24587)
-- Name: subscriber; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE subscriber (
    id bigint NOT NULL,
    name text COLLATE pg_catalog."ru_RU",
    object_id bigint DEFAULT 0,
    subdivision_id bigint DEFAULT 0,
    phone0 character(11) DEFAULT 0,
    phone1 character(11),
    phone2 character(11),
    phone3 character(11),
    "position" bigint DEFAULT 0 NOT NULL
);


ALTER TABLE subscriber OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 24585)
-- Name: subscriber_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE subscriber_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subscriber_id_seq OWNER TO postgres;

--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 185
-- Name: subscriber_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE subscriber_id_seq OWNED BY subscriber.id;


--
-- TOC entry 2036 (class 2604 OID 16423)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY object ALTER COLUMN id SET DEFAULT nextval('object_id_seq'::regclass);


--
-- TOC entry 2038 (class 2604 OID 16434)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subdivision ALTER COLUMN id SET DEFAULT nextval('subdivision_id_seq'::regclass);


--
-- TOC entry 2040 (class 2604 OID 24590)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subscriber ALTER COLUMN id SET DEFAULT nextval('subscriber_id_seq'::regclass);


--
-- TOC entry 2164 (class 0 OID 16420)
-- Dependencies: 182
-- Data for Name: object; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY object (id, name, "position") FROM stdin;
131	s	2
132	1	132
133	123	132
2	Светлинская ГЭС	-1
3	ПС "Районная"	-19
1	ОАО "ВГЭС-3"	0
6	ФилиалОАО "ВГЭС-3" Экспедиция №13	3
129	1	2
130	3	2
\.


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 181
-- Name: object_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('object_id_seq', 133, true);


--
-- TOC entry 2165 (class 0 OID 16429)
-- Dependencies: 183
-- Data for Name: subdivision; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY subdivision (id, name, object_id, "position") FROM stdin;
7	Технический отдел (ТО)	1	8
8	Сметно-договорной отдел (СДО)	1	9
5	Финансово-ивестиционный отдел (ФИНО)	1	6
2	Юридический кадровый отдел	1	2
11	Административно-хозяйственный отдел (АХО)	1	12
10	Отдел сбыта и учета электроэнергии (ОСУЭ)	1	11
14	Бухгалтерия	2	30
6	Планово-экономеческий отдел (ПЭО)	1	7
9	Отдел капитального строительства (ОКС)	1	10
20	Отдел материально-технического снабжения (ОМТС)	2	21
13	Администрация	2	1
17	Охрана	2	2
19	Столовая	2	30
21	Служба охраны труда и надежности (СОТН)	2	30
22	Производственно-технический отдел (ПТО)	2	30
23	Оперативная служба	2	30
24	Электроцех	2	30
25	Машинный цех	2	30
26	ЭТЛ	2	30
27	СДТУ	2	30
28	Гидроцех	2	30
29	ЗРУ-1 220кВ	2	30
30	ЗРУ-2 220кВ	2	30
31	Монтажная площадка (Отм. 165)	2	30
32	Технические отметки (отм. 154-123)	2	30
33	Водоприемник (отм. 184)	2	30
34	Администрация	6	30
35	Отдел кадров	6	30
36	Бухгалтерия	6	30
37	Геология	6	30
38	Геодезия	6	30
39	Гидрология	6	30
40	Служба натуральных наблюдений	6	30
41	Служба грунтовых сооружений	6	30
42	СГЭМ	7	30
16	Бюро пропусков	2	30
18	Вестибюль	2	30
1	Администрация	1	1
15	Мед. пункт	2	30
43	Касса аэрофлота	7	30
44	Церковь	7	30
45	ЭМС	7	30
48	Приемная	2	30
46	Приемная	1	3
12	Профком	1	13
47	Вахта	1	14
3	Отдел кадров	1	4
4	Бухгалтерия	1	5
\.


--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 184
-- Name: subdivision_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subdivision_id_seq', 48, true);


--
-- TOC entry 2168 (class 0 OID 24587)
-- Dependencies: 186
-- Data for Name: subscriber; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY subscriber (id, name, object_id, subdivision_id, phone0, phone1, phone2, phone3, "position") FROM stdin;
161	Факс	2	23	71180      	89248655259	           	           	2
88	Главный бухгалтер (Олзоева Татьяна Вячеславовна)	1	4	458        	89142519190	           	           	1
134	Обеденный зал	2	19	314        	           	           	           	2
87	Специалист по кадрам Светлинской ГЭС (Белослюдцева Мария Олеговна)	1	3	447        	           	           	           	1
113	Директор (Янель Валерий Викторович)	2	13	350        	70705      	89244664203	89142529642	1
132	Зав. столовой (Егодурова Светлана Григорьевна)	2	19	312        	           	           	           	1
112	Профком (Мельникова Наталья Васильевна)	1	12	359        	89248655296	           	           	1
114	Главный инженер (Крайнов Владимир Пертрович)	2	13	351        	70653      	70554      	89245933220	2
124	Начальник охраны (Телешева Виктория Станиславовна)	2	17	300        	           	           	           	1
79	Зам. ген. дир. по экономике (Пак Федор Николаевич)	1	1	460        	89141130555	           	           	3
85	Специалист по конкурсным закупкам (Мельникова Дарья Александровна)	1	2	437        	           	           	           	2
80	Приемная (Саввинова Алена Семеновна)	1	1	459        	71685      	71322      	           	4
157	Техническая библиотека	2	22	310        	           	           	           	9
119	Бухгалтер-материалист (Кошель Надежда Геннадьевна)	2	14	478        	           	           	           	1
159	Начальник (Парахонько Эдуард Павлович)	2	23	360        	89244664218	70701      	           	1
160	Начальник смены станции ЦПУ	2	23	352        	           	           	           	5
155	Архив (Ушакова Татьяна Владимировна)	2	22	410        	           	           	           	8
165	Начальник смены маш. зала	2	23	214        	           	           	           	4
158	Факс	2	22	267        	           	           	           	5
156	Множительная техника (Кравцова Наталья Борисовна)	2	22	411        	           	           	           	4
154	АСУ (Рязанов Александр Александрови)	2	22	493        	           	           	           	2
164	Дежурная машина радиостанция	2	23	506        	           	           	           	6
178	Радиостанция Мастер УГО (Кондратюк Игорь Евгеньевич)	2	24	521        	           	           	           	7
162	Радиостанция	2	23	504        	           	           	           	3
174	Радиостанция Начальник (Кийко Олег Федорович)	2	24	519        	           	           	           	1
175	Мастер уч. ВВО (Железняков Виктор Анатольевич)	2	24	274        	           	           	           	11
176	Радиостанция Мастер уч. ВВО (Железняков Виктор Анатольевич)	2	24	520        	           	           	           	2
172	Зам. ген.дир. по производству (Янель Валерий Викторович)	1	1	451        	89244664203	89142529642	71684      	1
171	Генеральный директор (Малько Александр Владимирович)	1	1	450        	89142550555	71120      	           	2
81	Начальник (Шконда Лариса Владимировна)	1	2	400        	89244664217	           	           	82
90	Ведущий бухгалтер (Юлаева Ирина Ивановна)	1	4	468        	           	           	           	4
120	Бухгалтер-материалист (Мачихина Оксана Геннадьевна)	2	14	436        	           	           	           	2
89	Зам. гл. бухгалтера (Губина Ольга Николаевна)	1	4	418        	           	           	           	2
92	Бухгалтер по налогам (Курилович Татьяна Владимировна)	1	4	428        	           	           	           	5
93	Бухгалтер-расчетчик (Алексеева Сардана Анатольевна)	1	4	498        	           	           	           	6
115	Зам. директора по снабжению и общим вопросам (Разыков Диловар Абубакрович)	2	13	462        	89142528470	           	           	3
86	Специалист по кадрам (Маковская Лидия Михайловна)	1	3	457        	357        	           	           	2
91	Бухгалтер-материалист (Задорожная Галина Сергеевна)	1	4	448        	           	           	           	3
116	Примная (Мельникова Наталья Васильевна)	2	48	359        	71716      	89248655296	           	10
136	Инженер ОМТС (Гаршина Наталья Федоровна)	2	20	407        	           	           	           	5
182	Мастер (Никонов Павел Сергеевич)	2	24	254        	           	           	           	5
170	Начальник (Кийко Олег Федорович)	2	24	373        	70531      	           	           	3
179	Ст. мастер (Таточенко Валерий Иванович)	2	24	334        	           	           	           	6
177	Мастер УГО (Кондратюк Игорь Евгеньевич)	2	24	355        	           	           	           	10
84	Специалист по конкурсным закупкам (Козликова Ирина Юрьевна)	1	2	430        	89241641616	           	           	3
117	Главный бухгалтер (Николаенко Алла Геннадьевна)	2	14	488        	           	           	           	3
140	Агент по снабжению (Мазур Надежда Викторовна)	2	20	405        	89244664232	           	           	7
135	Начальник (Гайфулина Наталья Алексеевна)	2	20	467        	89244664228	           	           	1
82	Юристконсульт (Егорова Татьяна Семеновна)	1	2	402        	           	           	           	4
137	Инженер ОМТС (Салтыкова Анна Андреевна)	2	20	406        	           	           	           	2
181	Радиостанция	2	24	518        	           	           	           	8
118	Бухгалтер-расчетчик (Володькина Лариса Михайловна)	2	14	438        	           	           	           	4
138	Инженер ОМТС (Литовка Евгений Игоревич)	2	20	408        	           	           	           	8
83	Юристконсульт (Доржиева Ирина Валерьевна)	1	2	431        	89244664227	           	           	5
180	Ст. мастер ГО (Парфенов Александр Аркадьевич)	2	24	374        	           	           	           	4
168	Радиостанция МГА	2	23	503        	           	           	           	7
173	Касса	2	14	338        	           	           	           	5
141	Зав. складом (Хрин Ирина Васильевна)	2	20	367        	           	           	           	4
139	Техник (Маковская Мария Сергеевна)	2	20	409        	           	           	           	3
169	Помещение ОС ЗРУ-2	2	23	329        	           	           	           	9
166	Радиостанция НСМ	2	23	501        	505        	           	           	10
167	Радиостанция ДЭМ	2	23	502        	           	           	           	12
163	Дежурная машина	2	23	89244664214	           	           	           	11
97	Экономист (Петрова Людмила Генадьевна)	1	5	476        	           	           	           	3
105	Начальник (Прудниченкова Софья Юрьевна)	1	9	464        	89241643888	           	           	1
102	Начальник (Бурлака Владимир Васильевич)	1	7	465        	89244664229	           	           	1
110	Заведующая (Малых Полина Васильевна)	1	11	477        	           	           	           	1
108	Ведущий инженер (Паньшина Ольга Михайловна)	1	10	440        	           	           	           	1
111	Вахта	1	47	479        	           	           	           	1
106	Зам. начальник (Сафронова Людмила Викторовна)	1	9	414        	           	           	           	2
99	Начальник ОТиЗ (Ковалева Любовь Григорьевна)	1	6	453        	           	           	           	2
100	Экономист (Швардова Ирина Васильевна)	1	6	452        	           	           	           	3
98	Начальник (Старшинова Еена Александровна)	1	6	455        	89244664234	           	           	1
94	Бухгалтер (Филипова Наталья Сергеевна)	1	4	487        	           	           	           	7
109	Инженер (Пешков Александр Васильевич)	1	10	489        	           	           	           	2
103	Начальник (Гладуненко Вера Викторовна)	1	8	494        	89244664241	           	           	1
101	Экономист (Афанасьева Мария Сергеевна)	1	6	485        	89244664235	           	           	4
95	Начальник (Скорина Наталья Владимировна)	1	5	456        	89241641414	           	           	1
96	Экономист (Захарова Екатерина Сергеевна)	1	5	475        	           	           	           	2
107	Инженер (Нестеров Евгений Анатольевич)	1	9	484        	           	           	           	3
128	Пост №2 Радиостанция	2	17	509        	511        	           	           	5
129	Пост №3	2	17	192        	193        	           	           	6
145	Зам. начю по ГО и ЧС (Сонько Николай Васильевич)	2	21	253        	           	           	           	2
152	Инженер (Быкодерова Марина Николаевна)	2	22	369        	           	           	           	12
143	Факс	2	20	474        	           	           	           	6
130	Пост №3 Радиостанция	2	17	508        	512        	           	           	7
142	Склад отм.154 (Хрин Ирина Васильевна)	2	20	377        	           	           	           	9
150	Инженер (Капцова Елена Анатольевна)	2	22	307        	           	           	           	11
153	Инженер (Николаева Яна Валерьевна)	2	22	145        	           	           	           	10
104	Общий	1	8	424        	           	           	           	2
127	Пост №2	2	17	200        	           	           	           	4
151	Инженер (Парахонько Анжелика Александровна)	2	22	315        	           	           	           	7
144	Начальник (Таточенко Татьяна Ивановна)	2	21	353        	           	           	           	1
131	Вестибюль	2	18	210        	           	           	           	1
149	Инженер (Дашиев Дондок Владимирович)	2	22	368        	           	           	           	6
146	Инженер (Губин Дмитрий Иванович)	2	21	277        	           	           	           	4
147	Инженер по экологии (Соколова Марина Григорьевна)	2	21	425        	           	           	           	3
126	Пост №1 Радиостанция	2	17	507        	510        	           	           	3
133	Столовая	2	19	313        	           	           	           	3
148	Начальник (Федотов Леонид Степанович)	2	22	365        	89244678053	           	           	1
125	Пост №1	2	17	319        	207        	           	           	2
122	Цеховой врач (Смольникова Александра Анатольевна)	2	15	203        	           	           	           	1
123	Дежурный (Бугаёва Виктория Станиславовна)	2	16	354        	           	           	           	1
\.


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 185
-- Name: subscriber_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subscriber_id_seq', 184, true);


--
-- TOC entry 2046 (class 2606 OID 16425)
-- Name: object_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY object
    ADD CONSTRAINT object_pkey PRIMARY KEY (id);


--
-- TOC entry 2048 (class 2606 OID 16436)
-- Name: subdivision_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subdivision
    ADD CONSTRAINT subdivision_pkey PRIMARY KEY (id);


--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2018-02-20 08:38:47 +09

--
-- PostgreSQL database dump complete
--

