USE [SRO_VT_ACCOUNT]
GO

/****** Object:  Table [dbo].[websro_support]    Script Date: 05/24/2013 22:10:34 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[websro_support](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Title] [varchar](50) NULL,
	[Cont] [varchar](250) NULL,
	[Date] [datetime] NULL,
	[Sendby] [varchar](50) NULL,
	[Type] [varchar](50) NULL,
 CONSTRAINT [PK_support] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


