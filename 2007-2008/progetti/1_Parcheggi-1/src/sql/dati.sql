
# Inserimento degli utenti
INSERT INTO Indirizzo (via, n_civico, comune, provincia, cap) VALUES ('gestione parcheggi', '2', 'the internet', 'IT', '00000');
INSERT INTO Utente (nome, cognome, d_nascita, l_nascita, username, password, email, id_indirizzo) VALUES ('Administrator', 'Bofh', 2000-01-01, 'The Internet', 'admin', md5('admin'), 'root@localhost', 1);

# Inserimento dei gruppi
INSERT INTO Gruppo (nome) VALUES ('Amministratori');
INSERT INTO Gruppo (nome) VALUES ('Gestori di Parcheggi');
INSERT INTO Gruppo (nome) VALUES ('Utenti Registrati');

# Afferimento degli utenti nei gruppi
INSERT INTO R1 (id_utente, id_gruppo) VALUES (1, 1);
INSERT INTO R1 (id_utente, id_gruppo) VALUES (1, 2);
INSERT INTO R1 (id_utente, id_gruppo) VALUES (1, 3);

# Inserimento dei permessi per gli amministratori
INSERT INTO Permesso VALUES ('Utente', 3, 1);
INSERT INTO Permesso VALUES ('Indirizzo', 3, 1);
INSERT INTO Permesso VALUES ('Automezzo', 3, 1);
INSERT INTO Permesso VALUES ('Modello', 4, 1);
INSERT INTO Permesso VALUES ('Carta_Credito', 3, 1);
INSERT INTO Permesso VALUES ('Parcheggio', 3, 1);
INSERT INTO Permesso VALUES ('Posto_Auto', 3, 1);
INSERT INTO Permesso VALUES ('Annuncio', 4, 1);
INSERT INTO Permesso VALUES ('Gruppo', 4, 1);
INSERT INTO Permesso VALUES ('R1', 4, 1);

# Inserimento dei permessi per i gestori di parcheggi
INSERT INTO Permesso VALUES ('Parcheggio', 1, 2);
INSERT INTO Permesso VALUES ('Posto_Auto', 1, 2);
INSERT INTO Permesso VALUES ('Annuncio', 1, 2);
