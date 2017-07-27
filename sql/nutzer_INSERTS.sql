INSERT INTO nutzer.users (username, password) VALUES ('Admin', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO nutzer.users (username, password) VALUES ('Lehrer', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO nutzer.users (username, password) VALUES ('TestNutzerA', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO nutzer.users (username, password) VALUES ('TestNutzer11A', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO nutzer.users (username, password) VALUES ('TestNutzer11ffA', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO nutzer.users (username, password) VALUES ('Nutzer', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO nutzer.users (username, password) VALUES ('1', '098f6bcd4621d373cade4e832627b4f6');

INSERT INTO nutzer.user_roles (role) VALUES ('Admin');
INSERT INTO nutzer.user_roles (role) VALUES ('Lehrer');

INSERT INTO nutzer.user_has_roles (id_users, id_roles) VALUES (1, 1);
INSERT INTO nutzer.user_has_roles (id_users, id_roles) VALUES (2, 2);
INSERT INTO nutzer.user_has_roles (id_users, id_roles) VALUES (18, 1);